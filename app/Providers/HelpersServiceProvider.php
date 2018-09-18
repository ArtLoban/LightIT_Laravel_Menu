<?php

namespace App\Providers;

use App\Helpers\ColorPicker\ColorPicker;
use App\Helpers\ColorPicker\ColorPickerInterface;
use App\Helpers\Hash\HashService;
use App\Helpers\Hash\HashServiceInterface;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HashServiceInterface::class, HashService::class);
        $this->app->bind(ColorPickerInterface::class, ColorPicker::class);
    }
}
