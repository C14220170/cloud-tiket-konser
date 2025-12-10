<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = $user->orders()
            ->with('event')
            ->latest()
            ->get();

        return view('tickets.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) { 
            abort(403, 'Unauthorized action.');
        }

        if (!$order->qr_code) {
            
            $qrContent = "ORDER-{$order->id}-USER-" . Auth::id();
            
            $fileName = "qrcodes/order-{$order->id}.svg";
            
            $qrImage = QrCode::format('svg')->size(300)->generate($qrContent);
            
            Storage::disk('public')->put($fileName, $qrImage);

            $order->update(['qr_code' => $fileName]);
        }

        return view('tickets.show', compact('order'));
    }
}