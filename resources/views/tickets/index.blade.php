<x-app-layout>

<div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-16 px-6">

    <div class="max-w-5xl my-4 mx-auto">

        <h1 class="text-4xl font-bold mb-8">My Tickets</h1>

        @forelse($orders as $order)

            <div class="bg-[#0F1F45]/50 backdrop-blur-xl p-6 rounded-2xl border border-white/10 shadow-lg mb-6">

                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

                    <div>
                        <div class="text-lg font-semibold text-indigo-300">
                            Order #{{ $order->id }}
                        </div>

                        <div class="mt-1 text-gray-300">
                            <span class="font-semibold">Total:</span>
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </div>

                        <div class="text-sm text-gray-400 mt-2 leading-relaxed">
                            <p>Status: <span class="capitalize">{{ $order->status }}</span></p>
                            <p>{{ $order->created_at->format('d M Y · H:i') }}</p>
                        </div>

                        <div class="mt-3 text-sm text-gray-300">
                            <p><span class="font-semibold text-indigo-300">Event:</span> {{ $order->event->title }}</p>
                            <p><span class="font-semibold text-indigo-300">Venue:</span> {{ $order->event->location }}</p>
                            <p><span class="font-semibold text-indigo-300">Date:</span> {{ $order->event->start_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="min-w-[150px]">
                        <a href="{{ route('tickets.show', $order->id) }}"
                           class="block w-full text-center px-4 py-3 rounded-xl font-semibold
                                  border border-indigo-400 text-indigo-300
                                  hover:bg-indigo-500 hover:text-white hover:border-indigo-500
                                  transition">
                            View Ticket →
                        </a>
                    </div>

                </div>

            </div>

        @empty
            
            <div class="bg-[#0F1F45]/40 backdrop-blur-xl p-6 rounded-xl border border-white/10 text-center mt-10">
                <p class="text-gray-300 text-lg">Kamu belum memiliki tiket.</p>
            </div>

        @endforelse

    </div>

</div>
</x-app-layout>