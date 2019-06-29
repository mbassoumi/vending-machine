<?php

namespace App\Providers;

use App\Repositories\MoneyInterface;
use App\Repositories\Services\MoneyService;
use App\Repositories\Services\SnackService;
use App\Repositories\Services\VendingMachineService;
use App\Repositories\SnackInterface;
use App\Repositories\VendingMachineInterface;
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
        $this->app->bind(
            MoneyInterface::class,
            MoneyService::class
        );
        $this->app->bind(
            SnackInterface::class,
            SnackService::class
        );
        $this->app->bind(
            VendingMachineInterface::class,
            VendingMachineService::class
        );
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
