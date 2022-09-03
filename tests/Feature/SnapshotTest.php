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

    $rules = (new StoreMovieRequest())->rules();

    expect($rules)->toMatchArray([
        // NOTE: Snapshot of validation goes here :-)
    ]);
});
