<x-app-layout>
<div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white">

    <section class="relative pt-24 pb-32">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            <div class="px-2">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                    Book your <br>
                    <span class="text-indigo-400">Tickets for Events!</span>
                </h1>

                <p class="mt-6 text-gray-300 text-lg">
                    Safe • Secure • Reliable  
                    <br>Your gateway to unforgettable experiences.
                </p>

                <a href="{{ route('events.index') }}"
                    class="inline-block mt-8 px-7 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/30 hover:scale-[1.03] transition">
                    View More →
                </a>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <img src="{{ asset('storage/banner1.jpg') }}" class="rounded-2xl shadow-xl object-cover h-48 md:h-64 border border-white/10">
                <img src="{{ asset('storage/banner2.jpg') }}" class="rounded-2xl shadow-xl object-cover h-48 md:h-64 mt-10 border border-white/10">
                <img src="{{ asset('storage/banner3.jpg') }}" class="rounded-2xl shadow-xl object-cover h-48 md:h-64 border border-white/10">
                <img src="{{ asset('storage/banner4.jpg') }}" class="rounded-2xl shadow-xl object-cover h-48 md:h-64 mt-10 border border-white/10">
            </div>

        </div>
    </section>

    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-[#0D1B3C]/40 backdrop-blur-xl p-12 rounded-3xl shadow-2xl border border-white/10">

                <div class="mb-10">
                    <h2 class="text-3xl font-bold mb-2">Featured Events</h2>
                    <p class="text-gray-300">Don’t miss these amazing upcoming shows.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-10">

                    @foreach ($featured as $event)
                        <div class="rounded-2xl overflow-hidden shadow-xl bg-[#0F1F45]/50 backdrop-blur-lg border border-white/10 hover:scale-[1.02] transition">

                            <img src="{{ asset('storage/' . $event->image) }}"
                                 class="w-full h-48 object-cover">

                            <div class="p-6">
                                
                                <div class="text-sm text-indigo-300 font-semibold">
                                    Rp {{ number_format($event->price) }}
                                </div>

                                <div class="font-bold text-xl mt-2">
                                    {{ $event->title }}
                                </div>

                                <div class="text-gray-400 text-sm mt-1">
                                    {{ \Carbon\Carbon::parse($event->start_at)->format('d M') }}
                                    • {{ $event->location }}
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