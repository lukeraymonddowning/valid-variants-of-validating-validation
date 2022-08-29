<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use function Safe\json_decode;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'released_on' => Carbon::parse($this->faker->dateTimeBetween('-50 years', '-2 months')),
            'rating' => $this->faker->randomElement(['PG-13', 'TV-14', 'R', 'N/A']),
            'runtime' => "{$this->faker->numberBetween(90, 180)} minutes",
            'director' => $this->faker->name,
            'plot' => $this->faker->paragraph(),
            'poster_url' => $this->faker->imageUrl(1080, 1920),
        ];
    }
}
