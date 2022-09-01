<?php

use App\Enums\MovieRating;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('autofill/directors', function () {
    return Director::select(['id', 'name'])->get()->toJson();
})->name('autofill.directors');

Route::get('autofill/movie-ratings', function () {
    return MovieRating::cases();
})->name('autofill.movie-ratings');
