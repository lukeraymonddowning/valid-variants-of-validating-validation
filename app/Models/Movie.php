<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'released_on' => 'date',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }
}
