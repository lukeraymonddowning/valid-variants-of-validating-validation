<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Movies', [
            'movies' => fn () => Movie::orderBy('name')
                ->with(['director'])
                ->when(
                    $request->filled('search'),
                    fn (Builder $query) => $query->where('name', 'like', "%{$request->query('search')}%")
                )
                ->get(),
        ]);
    }

    public function store(StoreMovieRequest $request)
    {
        $posterUrl = $request->poster()->store('movie-posters', 'public');

        Movie::make([
            ...$request->dataForMovie(),
            'runtime' => "{$request->dataForMovie()['runtime']} min",
            'poster_url' => $posterUrl,
        ])
            ->director()
            ->associate($this->handleDirector($request))
            ->save();

        return redirect(route('movies.index'));
    }

    private function handleDirector(StoreMovieRequest $request): Director
    {
        if ($request->validated()['director_id'] !== null) {
            return Director::findOrFail($request->validated()['director_id']);
        }

        $portraitUrl = $request->directorPortrait()->store('director-portraits', 'public');

        return Director::create([
            ...$request->dataForDirector(),
            'portrait_url' => $portraitUrl,
        ]);
    }
}
