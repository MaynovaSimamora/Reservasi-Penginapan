<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'        => 'Standard View',
                'location'    => 'Makassar',
                'type'        => 'standard',
                'capacity'    => 2,
                'price'       => 800000,
                'description' => 'Kamar standar dengan pemandangan kolam renang dan suasana hangat.',
                'thumbnail'   => 'images/rooms/standard-view.jpg',
            ],
            [
                'name'        => 'Deluxe Pool',
                'location'    => 'Miami',
                'type'        => 'deluxe',
                'capacity'    => 2,
                'price'       => 1500000,
                'description' => 'Kamar deluxe dengan akses langsung ke kolam renang dan area lounge.',
                'thumbnail'   => 'images/rooms/deluxe-pool.jpg',
            ],
            [
                'name'        => 'Villa Sunset',
                'location'    => 'Los Angeles',
                'type'        => 'suite',
                'capacity'    => 4,
                'price'       => 3000000,
                'description' => 'Villa suite luas dengan sunset view dan private deck.',
                'thumbnail'   => 'images/rooms/villa-sunset.jpg',
            ],
            [
                'name'        => 'Skyline Suite',
                'location'    => 'Jakarta',
                'type'        => 'suite',
                'capacity'    => 3,
                'price'       => 2200000,
                'description' => 'Suite modern di lantai tinggi dengan pemandangan kota.',
                'thumbnail'   => 'images/rooms/skyline-suite.jpg',
            ],
            [
                'name'        => 'Garden Deluxe',
                'location'    => 'Bandung',
                'type'        => 'deluxe',
                'capacity'    => 3,
                'price'       => 1200000,
                'description' => 'Kamar deluxe dengan teras dan akses langsung ke taman.',
                'thumbnail'   => 'images/rooms/garden-deluxe.jpg',
            ],
        ];

        foreach ($data as $item) {
            Room::create([
                'name'            => $item['name'],
                'slug'            => Str::slug($item['name']).'-'.Str::random(5),
                'location'        => $item['location'],
                'type'            => $item['type'],
                'description'     => $item['description'],
                'capacity'        => $item['capacity'],
                'price_per_night' => $item['price'],
                'thumbnail'       => $item['thumbnail'],  // nanti disesuaikan dengan file gambar
                'is_active'       => true,
            ]);
        }
    }
}
