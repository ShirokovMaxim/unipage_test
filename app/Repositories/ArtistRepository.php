<?php


namespace App\Repositories;


use App\Models\Artist;
use App\Repositories\Interfaces\IArtistRepository;

class ArtistRepository implements IArtistRepository
{

    public function createOrUpdate($data)
    {
        $artist = Artist::firstOrNew(['id' => $data['id']]);
        $artist->fill($data);
    }
}
