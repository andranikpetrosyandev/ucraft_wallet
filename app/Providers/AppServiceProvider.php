<?php

namespace App\Providers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Services\Core\TransactionService;
use App\Services\Core\Transfer\InternalTransfer;
use App\Services\Core\TransferService;
use App\Services\Core\UserService;
use App\Services\Core\WalletService;
use App\Services\Impl\TransactionServiceImpl;
use App\Services\Impl\UserServiceImpl;
use App\Services\Impl\WalletServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\TransferServiceImpl;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(UserService::class, function ($app) {
            return new UserServiceImpl($app->make(UserRepository::class));
        });

        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionServiceImpl($app->make(TransactionRepository::class), $app->make(WalletService::class));
        });

        $this->app->bind(TransferService::class, function ($app) {
            return new TransferServiceImpl($app->make(TransactionService::class), $app->make(WalletService::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
