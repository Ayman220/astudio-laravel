<?php

namespace App\Providers;

use App\Services\Facades\FUser;
use App\Services\Interfaces\IUser;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
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
        $this->app->singleton(IUser::class, FUser::class);
    }
}
