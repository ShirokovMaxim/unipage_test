<?php


namespace App\Repositories;


use App\Models\Track;
use App\Repositories\Interfaces\ITrackRepository;

class TrackRepository implements ITrackRepository
{

    public function createOrUpdate($data)
    {
        $track = Track::firstOrNew(['id' => $data['id']]);
        $track->fill($data);
    }
}
