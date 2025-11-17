<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white">

    {{-- ================= HERO SECTION ================= --}}
    <section class="relative pt-24 pb-32">

        {{-- FULL WIDTH --}}
        <div class="w-full max-w-7xl mx-auto px-4 md:px-0 grid md:grid-cols-2 gap-12 items-center">

            {{-- TEXT LEFT --}}
            <div class="px-2">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                    Book your <br>
                    <span class="text-indigo-400">Tickets for Event!</span>
                </h1>

                <p class="mt-6 text-gray-300">
                    Safe, Secure, Reliable ticketing.
                    <br>Your ticket to live entertainment!
                </p>

                <a href="{{ route('events.index') }}"
                    class="inline-block mt-8 px-6 py-3 bg-white text-black rounded-lg font-semibold shadow-lg hover:scale-105 transition">
                    View More →
                </a>
            </div>

            {{-- IMAGE GRID RIGHT --}}
            <div class="grid grid-cols-2 gap-4 md:gap-5">
                <img src="{{ asset('storage/banner1.jpg') }}" class="rounded-xl shadow-lg object-cover h-48 md:h-64">
                <img src="{{ asset('storage/banner2.jpg') }}" class="rounded-xl shadow-lg object-cover h-48 md:h-64 mt-10">
                <img src="{{ asset('storage/banner3.jpg') }}" class="rounded-xl shadow-lg object-cover h-48 md:h-64">
                <img src="{{ asset('storage/banner4.jpg') }}" class="rounded-xl shadow-lg object-cover h-48 md:h-64 mt-10">
            </div>
        </div>
    </section>



    {{-- ================= FEATURED EVENTS ================= --}}
    <section class="py-20">

        {{-- FULL WIDTH BUT CENTERED --}}
        <div class="w-full max-w-7xl mx-auto px-4 md:px-0">

            <div class="bg-[#0D1B3C]/70 backdrop-blur-xl p-10 rounded-3xl shadow-xl border border-white/10">

                <h2 class="text-3xl font-bold mb-3">Featured Events</h2>
                <p class="text-gray-300 mb-10">Be sure not to miss these Event today.</p>

                {{-- EVENTS GRID --}}
                <div class="grid md:grid-cols-3 gap-8">

                    @foreach ($featured as $event)
                        <div class="bg-[#0F1F45] rounded-2xl overflow-hidden shadow-lg border border-white/5">

                            {{-- IMAGE --}}
                            <img src="{{ asset('storage/' . $event->image) }}"
                                 class="w-full h-48 object-cover">

                            <div class="p-6">
                                
                                <div class="text-sm text-gray-300">
                                    Rp{{ number_format($event->min_price) }} – Rp{{ number_format($event->max_price) }}
                                </div>

                                <div class="font-bold text-xl mt-2">
                                    {{ $event->title }}
                                </div>

                                <div class="text-gray-400 text-sm mt-1">
                                    {{ \Carbon\Carbon::parse($event->start_at)->format('d M') }}
                                    | {{ $event->venue }}
                                </div>

                                <a href="{{ route('events.show', $event->id) }}"
                                    class="mt-6 block w-full text-center py-3 rounded-xl font-semibold border border-indigo-400 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white transition">
                                    Get Tickets →
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>

</div>
</x-app-layout>
