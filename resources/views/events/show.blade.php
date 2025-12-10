<x-app-layout>

    <section class="relative bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] text-white py-20 px-6">

        <div class="max-w-5xl mx-auto text-center">

            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                {{ $event->title }}
            </h1>

            <p class="mt-5 text-gray-300 text-lg max-w-2xl mx-auto leading-relaxed">
                {{ $event->description }}
            </p>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-lg mx-auto">

                <div class="bg-[#0F1530]/50 backdrop-blur-xl border border-white/10 
                    rounded-2xl px-6 py-4 shadow-lg text-left">
                    <h3 class="text-indigo-400 text-sm font-semibold">Date</h3>
                    <p class="mt-1 text-gray-200">
                        {{ \Carbon\Carbon::parse($event->start_at)->format('d M Y, H:i') }}
                    </p>
                </div>

                <div class="bg-[#0F1530]/50 backdrop-blur-xl border border-white/10 
                    rounded-2xl px-6 py-4 shadow-lg text-left">
                    <h3 class="text-indigo-400 text-sm font-semibold">Venue</h3>
                    <p class="mt-1 text-gray-200">
                        {{ $event->location }}
                    </p>
                </div>

            </div>

        </div>

    </section>

    <section class="bg-[#050718] text-white px-6 py-16">
        <div class="max-w-5xl mx-auto">

            <h2 class="text-3xl font-bold mb-8">Buy Ticket</h2>
            
            @if(session('error'))
                <div class="bg-red-500/20 text-red-200 p-3 rounded mb-4 border border-red-500/50">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('events.checkout', $event->id) }}" method="POST">
                @csrf

                <div class="bg-[#101935]/50 backdrop-blur-xl border border-indigo-500/20 
                    rounded-2xl p-6 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="text-xl font-semibold">General Ticket</h4>

                            <p class="mt-2 text-gray-300">
                                Rp {{ number_format($event->price) }}
                                <span class="ml-2 text-xs text-indigo-300">
                                    • Stock: {{ $event->qty }}
                                </span>
                            </p>
                        </div>

                        <div class="w-24">
                            <input
                                type="number"
                                min="1"
                                max="{{ $event->qty }}"
                                name="qty" 
                                value="1"
                                class="w-full text-center bg-[#0C1128] border border-indigo-400/30 
                                    rounded-lg py-1 text-white"
                            >
                        </div>

                    </div>

                </div>

                <div class="mt-12">

                    @auth
                        <button 
                            type="submit"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold 
                                rounded-xl shadow-lg transition w-full md:w-auto">
                            Proceed to Payment →
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold 
                                rounded-xl shadow-lg transition w-full md:w-auto block text-center">
                            Login to Buy Tickets
                        </a>
                    @endauth

                </div>

            </form>

        </div>
    </section>

</x-app-layout>