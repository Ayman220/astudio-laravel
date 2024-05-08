<?php

namespace App\Providers;

use App\Services\Facades\FProject;
use App\Services\Facades\Ftimesheet;
use App\Services\Facades\FUser;
use App\Services\Interfaces\IProject;
use App\Services\Interfaces\ITimesheet;
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
        $this->app->singleton(IProject::class, FProject::class);
        $this->app->singleton(ITimesheet::class, Ftimesheet::class);
    }
}
