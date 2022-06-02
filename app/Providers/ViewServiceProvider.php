<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\View\Composers\DarkModeComposer');
        View::composer('*', 'App\View\Composers\ColorSchemeComposer');
        View::composer('*', 'App\View\Composers\ConfigurationComposer');

        View::composer('backend.layouts.app', 'App\View\Composers\MenuComposer');
    }
}
