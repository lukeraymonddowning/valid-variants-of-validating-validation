<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Director extends Model
{
    use HasFactory;

    protected $casts = [
        'born_on' => 'date',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
