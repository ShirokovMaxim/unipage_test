<?php

namespace App\Console\Commands;

use App\Exceptions\ArtistNotFound;
use App\Exceptions\RequestException;
use App\Repositories\Interfaces\IArtistRepository;
use App\Repositories\Interfaces\ITrackRepository;
use App\Services\Soundcloud;
use Illuminate\Console\Command;

class importTracksByArtist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracks:importByArtist {artistPermalinkUrl}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all tracks by artist';

    private $artistRepository;
    private $trackRepository;

    /**
     * Create a new command instance.
     *
     * @param IArtistRepository $artistRepository
     * @param ITrackRepository $trackRepository
     */
    public function __construct(IArtistRepository $artistRepository, ITrackRepository $trackRepository)
    {
        parent::__construct();

        $this->artistRepository = $artistRepository;
        $this->trackRepository = $trackRepository;
    }

    /**
     * Import all tracks by artist.
     *
     * @return int
     */
    public function handle()
    {
        $artistPermalinkUrl = $this->argument('artistPermalinkUrl');

        $soundCloud = new Soundcloud();

        try {
            $artist = $soundCloud->getArtistByPermalinkUrl($artistPermalinkUrl);

            $this->artistRepository->createOrUpdate($artist);

            $tracks = $soundCloud->getArtistTracks($artist['id']);

            foreach ($tracks as $track) {
                $track['artist_id'] = $artist['id'];
                $this->trackRepository->createOrUpdate($track);
            }

            $this->info('Success');
        } catch (ArtistNotFound $e) {
            $this->info($e->getMessage());

        } catch (RequestException $e) {
            $this->info($e->getMessage() . ' ' . json_encode($e->data));
        }

        return 0;
    }
}
