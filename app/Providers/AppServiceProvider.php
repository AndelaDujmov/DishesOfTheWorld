<?php

namespace App\Providers;

use App\Repositories\MealRepository;
use App\Repositories\MealRepositoryInterface;
use App\Services\MealService;
use App\Services\MealServiceInterface;
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
        $this->app->bind(MealRepositoryInterface::class, MealRepository::class);
        $this->app->bind(MealServiceInterface::class, MealService::class);
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
