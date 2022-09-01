<?php

use App\Enums\MovieRating;
use App\Models\Director;
use Illuminate\Http\UploadedFile;

it('requires a name', function () {
    $response = login()->post(route('movies.store'), [
        'name' => null,
        'poster' => UploadedFile::fake()->image('Poster', '1080', '1920'),
        'released_on' => '2005-11-12',
        'rating' => MovieRating::R->value,
        'runtime' => 132,
        'plot' => fake()->paragraph,
        'director_id' => Director::factory()->create()->id,
    ]);

    $response->assertInvalid(['name' => 'required']);
});

it('must use a string for the name', function () {
    $response = login()->post(route('movies.store'), [
        'name' => 1,
        'poster' => UploadedFile::fake()->image('Poster', '1080', '1920'),
        'released_on' => '2005-11-12',
        'rating' => MovieRating::R->value,
        'runtime' => 132,
        'plot' => fake()->paragraph,
        'director_id' => Director::factory()->create()->id,
    ]);

    $response->assertInvalid(['name' => 'string']);
});

it('has a max character limit of 255 for the name', function () {
    $response = login()->post(route('movies.store'), [
        'name' => str_repeat('a', 256),
        'poster' => UploadedFile::fake()->image('Poster', '1080', '1920'),
        'released_on' => '2005-11-12',
        'rating' => MovieRating::R->value,
        'runtime' => 132,
        'plot' => fake()->paragraph,
        'director_id' => Director::factory()->create()->id,
    ]);

    $response->assertInvalid(['name' => '255 characters']);
});
