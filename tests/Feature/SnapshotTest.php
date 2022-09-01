<?php

use App\Enums\MovieRating;
use App\Http\Controllers\MovieController;
use App\Http\Requests\StoreMovieRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;

it('has the correct rules', function () {
    // jasonmccreary/laravel-test-assertions
    $this->assertActionUsesFormRequest(MovieController::class, 'store', StoreMovieRequest::class);

    expect((new StoreMovieRequest())->rules())->toMatchArray([
        'name' => ['required', 'string', 'max:255'],
        'poster' => ['required', File::image()->max(1024 * 10)],
        'released_on' => ['required', 'date_format:Y-m-d'],
        'rating' => ['required', new Enum(MovieRating::class)],
        'runtime' => ['required', 'int', 'min:0'],
        'plot' => ['required', 'string'],
        'director_id' => ['required_without:director_name', 'nullable', Rule::exists('directors', 'id')],
        'director_name' => ['required_without:director_id', 'nullable', 'string'],
        'director_portrait' => ['required_with:director_name', 'nullable', File::image()->max(1024 * 10)],
        'director_born_on' => ['required_with:director_name', 'nullable', 'date_format:Y-m-d'],
    ]);
});
