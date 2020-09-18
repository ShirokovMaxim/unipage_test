<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'media_tracks';

    protected $fillable = [
        'id',
        'title',
        'description',
        'permalink',
        'duration',
        'genre',
        'release_date',
        'bpm',
        'artist_id'
    ];
}
