<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProductDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\ProductDetailSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // $this->call([
        //     AddressSeeder::class,
        // ]);

        // $this->call([
        //     ProductSeeder::class
        // ]);

        // $this->call([
        //     ProductSeeder::class
        // ]);
    }
}
