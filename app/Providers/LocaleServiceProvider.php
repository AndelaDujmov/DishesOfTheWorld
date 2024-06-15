<?php

namespace App\Providers;

use App\Models\Languages;
use Illuminate\Support\ServiceProvider;
use PSpell\Config;

class LocaleServiceProvider extends ServiceProvider
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
        $locales = Languages::pluck('name')->toArray();
        config(['translatable.locales' => $locales]);
    }
}
