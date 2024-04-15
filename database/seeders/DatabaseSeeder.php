<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Option;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $options = Option::factory(10)->create();

       User::factory()->create();

        Property::factory(30)
            ->hasImages(3)
            ->hasAttached($options->random(3))
            ->create();
    }
}
