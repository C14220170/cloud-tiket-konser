<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function home()
    {
        $featured = Event::latest()->take(3)->get();
        return view('index', compact('featured'));
    }

    public function index()
    {
        $events = Event::orderBy('start_at', 'asc')->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function checkout(Request $request, Event $event)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1|max:' . $event->qty,
        ]);

        if ($event->qty < $request->qty) {
            return back()->with('error', 'Maaf, stok tiket tidak mencukupi.');
        }

        $totalPrice = $event->price * $request->qty;

        $order = Order::create([
            'user_id'     => Auth::id(),
            'event_id'    => $event->id,
            'qty'         => $request->qty,
            'total_price' => $totalPrice,
            'status'      => 'paid',
            'qr_code'     => null,
        ]);

        $event->decrement('qty', $request->qty);

        return redirect()
            ->route('tickets.show', $order->id)
            ->with('success', 'Pembelian berhasil!');
    }
}