<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'test@example.com',
            'password' => "user",
        ]);

         $events = [
            [
                'title' => 'Rock Fest 2025',
                'description' => 'Festival rock terbesar tahun ini.',
                'start_at' => now()->addWeeks(2),
                'venue' => 'Stadion A',
                'image' => 'events/event1.jpg',
            ],
            [
                'title' => 'Indie Night',
                'description' => 'Malam musik indie intim.',
                'start_at' => now()->addWeeks(4),
                'venue' => 'Gedung Konser B',
                'image' => 'events/event2.jpg',
            ],
            [
                'title' => 'EDM Blast',
                'description' => 'Party EDM dengan DJ internasional.',
                'start_at' => now()->addMonths(2),
                'venue' => 'Arena C',
                'image' => 'events/event3.jpg',
            ],
        ];

        foreach ($events as $eData) {
            // sementara isi min/max price = 0, akan dihitung kemudian
            $event = Event::create(array_merge($eData, [
                'min_price' => 0,
                'max_price' => 0,
            ]));

            // Ticket types untuk event ini
            $ticketTypes = [
                ['name' => 'Basic', 'price' => 100000, 'quantity' => 100],
                ['name' => 'VIP', 'price' => 300000, 'quantity' => 25],
            ];

            $event->ticketTypes()->createMany($ticketTypes);

            // Hitung min & max price otomatis
            $prices = array_column($ticketTypes, 'price');

            $event->update([
                'min_price' => min($prices),
                'max_price' => max($prices),
            ]);
        }
    }
}
