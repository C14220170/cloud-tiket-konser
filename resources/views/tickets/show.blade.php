<x-app-layout>

<div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-16 px-6">

    <div class="max-w-4xl my-4 mx-auto">

        {{-- TITLE --}}
        <h1 class="text-4xl font-bold mb-8">Ticket Order #{{ $order->id }}</h1>

        <div class="bg-[#0F1F45]/50 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-xl">

            {{-- ORDER SUMMARY --}}
            <h2 class="text-2xl font-semibold mb-4">Order Summary</h2>

            <div class="space-y-2 text-gray-300">
                {{-- UPDATED: total_price --}}
                <p><span class="font-semibold text-indigo-300">Total:</span> Rp {{ number_format($order->total_price,0,',','.') }}</p>
                <p><span class="font-semibold text-indigo-300">Status:</span> <span class="capitalize">{{ $order->status }}</span></p>
                <p><span class="font-semibold text-indigo-300">Date:</span> {{ $order->created_at->format('d M Y · H:i') }}</p>
            </div>

            {{-- EVENT SUMMARY (UPDATED: Direct Access) --}}
            <div class="mt-6 space-y-1 text-gray-300">
                <p><span class="font-semibold text-indigo-300">Event:</span> {{ $order->event->title }}</p>
                <p><span class="font-semibold text-indigo-300">Venue:</span> {{ $order->event->location }}</p>
                <p><span class="font-semibold text-indigo-300">Event Date:</span> {{ $order->event->start_at->format('d M Y · H:i') }}</p>
            </div>

            <hr class="my-6 border-white/10">

            {{-- TICKET SECTION --}}
            <h2 class="text-2xl font-semibold mb-4">Your Tickets</h2>

            {{-- UPDATED: Removed Loop, Single Ticket Card --}}
            <div class="bg-[#0A1530] p-6 rounded-xl border border-white/10 shadow-lg 
                        flex flex-col lg:flex-row lg:items-center gap-6 mb-6">

                {{-- QR CODE (Updated to use Storage Image) --}}
                <div class="flex justify-center items-center bg-[#0F1F45] p-4 rounded-xl border border-white/10">
                    @if($order->qr_code)
                        <img src="{{ asset('storage/' . $order->qr_code) }}" class="w-44 h-44">
                    @else
                         <div class="text-xs text-center text-gray-400">QR Generating...<br>Refresh Page</div>
                    @endif
                </div>

                {{-- INFO --}}
                <div class="text-gray-300 space-y-1">
                    <p><span class="text-indigo-300 font-semibold">Ticket Type:</span> General Admission</p>
                    <p><span class="text-indigo-300 font-semibold">Quantity:</span> {{ $order->qty }} Pax</p>
                    <p><span class="text-indigo-300 font-semibold">Event:</span> {{ $order->event->title }}</p>
                    <p><span class="text-indigo-300 font-semibold">Venue:</span> {{ $order->event->location }}</p>
                    <p><span class="text-indigo-300 font-semibold">Date:</span> 
                        {{ $order->event->start_at->format('d M Y · H:i') }}
                    </p>                    
                </div>

            </div>

        </div>
    </div>

</div>

</x-app-layout>