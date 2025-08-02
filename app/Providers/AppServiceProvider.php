<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\EventServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
