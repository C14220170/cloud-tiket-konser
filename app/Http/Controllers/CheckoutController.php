<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Order;
use App\Models\TicketType;

class CheckoutController extends Controller
{
    use AuthorizesRequests;
    
    public function checkout(Request $req)
    {
        $user = $req->user();
        $itemsJson = $req->input('items');
        $items = json_decode($itemsJson, true) ?: [];

        if(empty($items)) return back()->with('error','No items selected.');

        try {
            $order = DB::transaction(function() use($user,$items){
                $order = Order::create([ 'user_id'=>$user->id, 'status'=>'pending', 'total'=>0 ]);
                $total = 0;
                foreach($items as $it){
                    $tt = TicketType::lockForUpdate()->findOrFail($it['ticket_type_id']);
                    if($tt->quantity < $it['quantity']){
                        throw new \Exception("Not enough stock for {$tt->name}");
                    }
                    $tt->quantity -= $it['quantity'];
                    $tt->save();

                    $order->items()->create([
                        'ticket_type_id' => $tt->id,
                        'quantity' => $it['quantity'],
                        'price' => $tt->price,
                    ]);

                    $total += $tt->price * $it['quantity'];
                }
                $order->total = $total;
                $order->save();
                return $order;
            });
        } catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        // Redirect to a simulated payment confirmation page
        return redirect()->route('checkout.confirm', ['order' => $order->id]);
    }

    public function confirm(Request $req, Order $order)
    {
        $this->authorize('view', $order);

        // Simulate payment success
        $order->status = 'paid';
        $order->save();

        // Generate a simple ticket file (JSON) and store in public disk
        $payload = [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'items' => $order->items()->with('ticketType')->get()->map(function($it){
                return [
                    'ticket_type' => $it->ticketType->name,
                    'qty' => $it->quantity,
                    'price' => $it->price,
                ];
            }),
            'total' => $order->total,
            'generated_at' => now()->toDateTimeString(),
        ];

        $path = 'tickets/order-'.$order->id.'.json';
        Storage::disk('public')->put($path, json_encode($payload, JSON_PRETTY_PRINT));
        $order->ticket_path = $path;
        $order->save();

        return redirect()->route('tickets.show', $order->id)->with('success','Payment succeeded — ticket generated.');
    }
}
