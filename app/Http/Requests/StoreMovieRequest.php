<?php

namespace App\Http\Requests;

use App\Enums\MovieRating;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;

class StoreMovieRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
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
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function dataForMovie(): array
    {
        return $this->safe()->only([
            'name',
            'released_on',
            'rating',
            'runtime',
            'plot',
        ]);
    }

    public function poster(): UploadedFile
    {
        return $this->file('poster');
    }

    public function dataForDirector(): array
    {
        return $this
            ->safe()
            ->collect()
            ->filter(fn ($value, $key) => str_starts_with($key, 'director_'))
            ->except(['director_id', 'director_portrait'])
            ->mapWithKeys(fn ($value, $key) => [Str::after($key, 'director_') => $value])
            ->all();
    }

    public function directorPortrait(): UploadedFile|null
    {
        return $this->file('director_portrait');
    }
}
