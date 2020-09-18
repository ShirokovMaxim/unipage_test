<?php

namespace App\Providers;

use App\Repositories\ArtistRepository;
use App\Repositories\Interfaces\IArtistRepository;
use App\Repositories\Interfaces\ITrackRepository;
use App\Repositories\TrackRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IArtistRepository::class,
            ArtistRepository::class
        );

        $this->app->bind(
            ITrackRepository::class,
            TrackRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
