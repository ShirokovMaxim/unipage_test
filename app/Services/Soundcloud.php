<?php


namespace App\Services;


use App\Exceptions\ArtistNotFound;
use App\Interfaces\IRequest;

class Soundcloud
{

    private $request;
    private $baseUrl = 'https://api.soundcloud.com';
    private $clientId;

    public function __construct()
    {
        $this->request = app(IRequest::class);
        $this->clientId = env('SOUNDCLOUD_CLIENT_ID');
    }

    /**
     * @param $artistId
     * @return array
     * @throws \App\Exceptions\RequestException
     */
    public function getArtistTracks($artistId) {
        $params = ['client_id' => $this->clientId];

        $tracks = $this->request->send('GET', "$this->baseUrl/$artistId/tracks", $params);

        return $tracks;
    }

    /**
     * @param $permalinkUrl
     * @return array
     * @throws ArtistNotFound
     * @throws \App\Exceptions\RequestException
     */
    public function getArtistByPermalinkUrl($permalinkUrl) {
        $artist = $this->resolve($permalinkUrl);

        if ($artist) {
            return $artist;
        } else {
            throw new ArtistNotFound('artist not found');
        }
    }

    /**
     * @param $url
     * @return array
     * @throws \App\Exceptions\RequestException
     */
    private function resolve($url) {
        $params = [
            'client_id' => $this->clientId,
            'url' => $url
        ];
        return $this->request->send('GET', "$this->baseUrl/resolve", $params);
    }
}
