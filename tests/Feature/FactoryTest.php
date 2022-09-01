<?php

use App\Enums\MovieRating;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->validData = [
        'name' => 'V for Vendetta',
        'poster' => UploadedFile::fake()->image('Poster.png', '1080', '1920'),
        'released_on' => '2005-11-12',
        'rating' => MovieRating::R->value,
        'runtime' => 132,
        'plot' => fake()->paragraph,
        'director_id' => Director::factory()->create()->id,
    ];
});

it('requires valid data', function ($data, $errors) {
    $response = login()->post(route('movies.store'), [
        ...$this->validData,
        ...$data,
    ]);

    $response->assertInvalid($errors);
})->with([
    'the name is null' => [['name' => null], ['name' => 'required']],
    'the name is not a string' => [['name' => 1], ['name' => 'string']],
    'the name is longer than 255 chars' => [['name' => str_repeat('a', 256)], ['name' => '255 characters']],
    'the rating is not a supported enum value' => [['rating' => 'foo'], ['rating' => 'invalid']],
]);

it('links the movie to the director', function () {
    login()->post(route('movies.store'), [
        ...$this->validData,
        'director_id' => null,
        'director_name' => 'Luke Downing',
        'director_portrait' => UploadedFile::fake()->image('Portrait.png', 120, 120),
        'director_born_on' => '1970-01-01',
    ])->assertValid();

    $movie = Movie::firstWhere('name', 'V for Vendetta');
    $director = Director::firstWhere('name', 'Luke Downing');

    expect($movie->director()->is($director));
});

it('stores the director portrait correctly', function () {
    Storage::fake('public');

    login()->post(route('movies.store'), [
        ...$this->validData,
        'director_id' => null,
        'director_name' => 'Luke Downing',
        'director_portrait' => UploadedFile::fake()->image('Portrait.png', 120, 120),
        'director_born_on' => '1970-01-01',
    ])->assertValid();

    $director = Director::firstWhere('name', 'Luke Downing');

    Storage::disk('public')->assertExists($director->portrait_url);
});

it('stores the director date of birth correctly', function () {
    login()->post(route('movies.store'), [
        ...$this->validData,
        'director_id' => null,
        'director_name' => 'Luke Downing',
        'director_portrait' => UploadedFile::fake()->image('Portrait.png', 120, 120),
        'director_born_on' => '1970-01-01',
    ])->assertValid();

    expect(Director::firstWhere('name', 'Luke Downing')->born_on->format('Y-m-d'))->toBe('1970-01-01');
});
