<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory

{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $keyword = $this->faker->randomDigit();
        return [
            // 'name' => "https://loremflickr.com/640/480/houses",
            'name' => $this->faker->imageUrl(604, 480, 'houses', true),
            // 'name' => 'https://picsum.photos/id/1029/600/420',
        ];
    }
}
