<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Order;

class TicketController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $req)
    {
        $orders = $req->user()->orders()
            ->where('status','paid')
            ->with('items.ticketType')
            ->latest()
            ->get();

        return view('tickets.index', compact('orders'));
    }

    public function show(Request $req, Order $order)
    {
        $this->authorize('view', $order);

        // Load relasi agar tidak null
        $order->load('items.ticketType.event');

        $content = null;
        if($order->ticket_path && Storage::disk('public')->exists($order->ticket_path)){
            $content = Storage::disk('public')->get($order->ticket_path);
        }

        // QR Code generator (tanpa Imagick)
        $qrPath = "qrcodes/order-{$order->id}.svg";

        if (!Storage::disk('public')->exists($qrPath)) {
            Storage::disk('public')->put(
                $qrPath,
                \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(260)
                    ->margin(1)
                    ->generate("VERIFY-TICKET-ORDER-{$order->id}")
            );
        }

        $qrUrl = asset('storage/' . $qrPath);

        return view('tickets.show', compact('order','content','qrUrl'));
    }

}
