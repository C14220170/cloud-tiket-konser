<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('user'),
        ]);

        $events = [
            [
                'title' => 'Rock Fest 2025',
                'description' => 'Festival rock terbesar tahun ini, menghadirkan band-band legendaris dan pendatang baru yang siap mengguncang panggung.',
                'start_at' => now()->addWeeks(2),
                'end_at' => now()->addWeeks(2)->addHours(5),
                'location' => 'Stadion Gelora Bung Karno',
                'image' => 'banner1.jpg',
                'qty' => 500,
                'price' => 150000,
            ],
            [
                'title' => 'Indie Night',
                'description' => 'Malam musik indie yang intim dan penuh makna. Cocok untuk menenangkan pikiran di akhir pekan.',
                'start_at' => now()->addWeeks(4),
                'end_at' => now()->addWeeks(4)->addHours(3),
                'location' => 'Gedung Kesenian Jakarta',
                'image' => 'banner2.jpg',
                'qty' => 200,
                'price' => 75000,
            ],
            [
                'title' => 'EDM Blast',
                'description' => 'Pesta musik elektronik dengan DJ internasional ternama. Siapkan energimu untuk berdansa semalaman!',
                'start_at' => now()->addMonths(2),
                'end_at' => now()->addMonths(2)->addHours(6),
                'location' => 'Eco Park Ancol',
                'image' => 'banner3.jpg',
                'qty' => 1000,
                'price' => 250000,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}