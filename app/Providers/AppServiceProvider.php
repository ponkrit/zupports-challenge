<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\JsonMapper::class, function () {
            $jsonMapper = new \JsonMapper();
            $jsonMapper->bStrictNullTypes = false;
            $jsonMapper->bEnforceMapType = false;

            return $jsonMapper;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
