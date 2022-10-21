<?php

namespace App\Providers;

use App\Repositories\WalletRepository;
use App\Services\Core\TransactionService;
use App\Services\Core\UserService;
use App\Services\Core\WalletService;
use App\Services\Impl\WalletServiceImpl;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WalletService::class, function ($app) {
            return new WalletServiceImpl($app->make(WalletRepository::class), $app->make(UserService::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
