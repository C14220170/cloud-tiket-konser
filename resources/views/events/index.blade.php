<x-app-layout>
<div class="min-h-screen bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-16 px-6">

    <div class="max-w-6xl my-4 mx-auto">

        <h1 class="text-4xl font-bold mb-10">All Events</h1>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach ($events as $event)
                <div class="bg-[#0F1F45] rounded-2xl overflow-hidden shadow-lg border border-white/5">

                    <img src="{{ asset('storage/' . $event->image) }}"
                         class="w-full h-52 object-cover">

                    <div class="p-5">
                        <p class="text-sm text-gray-300">
                            Rp{{ number_format($event->min_price) }} –
                            Rp{{ number_format($event->max_price) }}
                        </p>

                        <h2 class="text-xl font-semibold mt-2">{{ $event->title }}</h2>

                        <p class="text-gray-400 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y') }}
                            | {{ $event->venue }}
                        </p>

                        <a href="{{ route('events.show', $event->id) }}"
                           class="mt-5 block text-center py-3 border border-indigo-400 rounded-xl 
                           hover:bg-indigo-500 hover:text-white hover:border-indigo-500 transition">
                           View Event →
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

</div>
</x-app-layout>
