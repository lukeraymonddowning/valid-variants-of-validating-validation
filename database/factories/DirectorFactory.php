<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Director>
 */
class DirectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'born_on' => Carbon::parse($this->faker->dateTimeBetween('-65 years', '-25 years')),
            'portrait_url' => 'https://placeimg.com/120/120/people?id='.Str::random(5),
        ];
    }
}
