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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (\DB::getDriverName() === 'sqlite'){
            \DB::statement(\DB::raw('PRAGMA foreign_keys=1'));
        }

        $url->forceScheme('https');
    }
}