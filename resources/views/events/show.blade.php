<x-app-layout>

   {{-- ================= CLEAN HERO HEADER ================= --}}
    <section class="relative bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-20 px-6 shadow-lg">

        <div class="max-w-4xl py-4 mx-auto text-center">

            {{-- Title --}}
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                {{ $event->title }}
            </h1>

            {{-- Description --}}
            <p class="mt-5 text-gray-300 text-lg max-w-2xl mx-auto leading-relaxed">
                {{ $event->description }}
            </p>

            {{-- Info Cards Row --}}
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-5 max-w-lg mx-auto">

                {{-- Date --}}
                <div class="bg-[#0F1530]/60 backdrop-blur-xl border border-white/10
                            rounded-xl px-5 py-4 flex items-center space-x-3 text-left">
                    <div class="text-indigo-400 text-sm font-semibold">Date</div>
                    <div class="flex-1 text-gray-200">
                        {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, H:i') }}
                    </div>
                </div>

                {{-- Venue --}}
                <div class="bg-[#0F1530]/60 backdrop-blur-xl border border-white/10
                            rounded-xl px-5 py-4 flex items-center space-x-3 text-left">
                    <div class="text-indigo-400 text-sm font-semibold">Venue</div>
                    <div class="flex-1 text-gray-200">
                        {{ $event->venue }}
                    </div>
                </div>

            </div>

        </div>

    </section>




    {{-- ================= TICKET SECTION ================= --}}
    <section class="bg-[#050718] text-white px-6">
        <div class="max-w-5xl mx-auto">

            <h2 class="text-3xl font-bold mb-6">Available Tickets</h2>

            <form action="{{ route('checkout') }}" method="POST" id="checkoutForm">
                @csrf

                <input type="hidden" name="items" id="itemsInput">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @foreach($event->ticketTypes as $tt)
                    <div class="bg-[#101935] rounded-2xl p-6 border border-indigo-500/20 shadow-lg hover:scale-[1.02] transition">

                        <div class="flex items-center justify-between">

                            <div>
                                <h4 class="text-xl font-semibold text-white">{{ $tt->name }}</h4>

                                <p class="mt-1 text-sm text-gray-300">
                                    Rp {{ number_format($tt->price,0,',','.') }}
                                    <span class="ml-2 text-xs text-indigo-300">
                                        • Stock: {{ $tt->quantity }}
                                    </span>
                                </p>
                            </div>

                            {{-- Qty --}}
                            <div class="w-24">
                                <input
                                    type="number"
                                    min="0"
                                    max="{{ $tt->quantity }}"
                                    value="0"
                                    class="qty w-full text-center bg-[#0C1128] border border-indigo-400/30 rounded-lg py-1 text-white"
                                    data-id="{{ $tt->id }}"
                                    data-price="{{ $tt->price }}"
                                >
                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>



                {{-- ACTION BUTTON --}}
                <div class="mt-10">
                    @auth
                        <button 
                            type="button"
                            id="payBtn"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transition w-full md:w-auto"
                        >
                            Proceed to Payment →
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-xl shadow-lg transition w-full md:w-auto block text-center">
                            Login to Buy Tickets
                        </a>
                    @endauth
                </div>

            </form>

        </div>
    </section>



    {{-- ================= JS ================= --}}
    <script>
        document.getElementById('payBtn')?.addEventListener('click', function () {
            const quantities = document.querySelectorAll('.qty');
            const items = [];

            quantities.forEach(input => {
                let qty = parseInt(input.value) || 0;
                if (qty > 0) {
                    items.push({
                        ticket_type_id: parseInt(input.dataset.id),
                        quantity: qty
                    });
                }
            });

            if (items.length === 0) {
                alert('Pilih setidaknya 1 tiket.');
                return;
            }

            document.getElementById('itemsInput').value = JSON.stringify(items);
            document.getElementById('checkoutForm').submit();
        });
    </script>

</x-app-layout>
