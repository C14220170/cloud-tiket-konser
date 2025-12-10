<x-app-layout>
<div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-20 px-6">

    <div class="max-w-7xl mx-auto">

        <h1 class="text-4xl font-extrabold mb-10">All Events</h1>

        <div class="grid md:grid-cols-3 gap-10">

            @foreach ($events as $event)
                <div class="rounded-2xl overflow-hidden bg-[#0F1F45]/40 backdrop-blur-xl shadow-xl border border-white/10 hover:scale-[1.02] transition">

                    <img src="{{ asset('storage/' . $event->image) }}"
                         class="w-full h-52 object-cover">

                    <div class="p-6">

                        <p class="text-sm text-indigo-300 font-semibold">
                            Rp {{ number_format($event->price) }}
                        </p>

                        <h2 class="text-xl font-semibold mt-2 text-white">
                            {{ $event->title }}
                        </h2>

                        <p class="text-gray-400 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y') }}
                            • {{ $event->location }}
                        </p>

                        <a href="{{ route('events.show', $event->id) }}"
                           class="mt-6 block w-full text-center py-3 rounded-xl border border-indigo-400 text-indigo-200 
                           hover:bg-indigo-500 hover:text-white hover:border-indigo-500 transition font-semibold">
                           View Event →
                        </a>

                    </div>
                </div>
            @endforeach

        </div>

    </div>

</div>
</x-app-layout>