<?php

namespace App\Providers;

use App\Services\Charts\Contracts\ChartInterface;
use App\Services\Charts\ChartConstructor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ChartInterface::class, ChartConstructor::class);
    }
}
