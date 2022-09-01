<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use function Safe\json_decode;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = collect(json_decode(file_get_contents(__DIR__.'/fixtures/movies.json'), true))
            ->map(fn (array $data) => [
                'name' => $data['Title'],
                'released_on' => Carbon::parse($data['Released']),
                'rating' => $data['Rated'],
                'runtime' => $data['Runtime'],
                'director_id' => Director::factory(['name' => $data['Director']]),
                'plot' => $data['Plot'],
                'poster_url' => $data['Poster'],
            ]);

        Movie::factory()->count($data->count())->sequence(...$data->shuffle())->create();

        Director::factory()->create([
            'name' => 'James McTeigue',
            'portrait_url' => asset('assets/director-portraits/james-mcteigue.png'),
            'born_on' => Carbon::parse('1967-12-29'),
        ]);
    }
}
