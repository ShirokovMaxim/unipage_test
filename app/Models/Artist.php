<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'media_artists';

    protected $fillable = [
        'username',
        'full_name',
        'description',
        'permalink',
        'avatar_url',
        'county',
        'city'
    ];


}
