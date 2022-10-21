<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

Route::middleware('auth')->prefix('wallet')->group(function () {
    Route::get('/store', [WalletController::class, 'store'])->name("wallet.store");
    Route::post('/', [WalletController::class, 'create'])->name("wallet.create");
    Route::get('/{id}', [WalletController::class, 'single'])->name('wallet.single');
    Route::delete('/{id}', [WalletController::class, 'destroy'])->name('wallet.destroy');
    Route::put('/', [WalletController::class, 'update']);
});

Route::middleware('auth')->prefix('transaction')->group(function () {
    Route::get('/store/{wallet_id?}', [TransactionController::class, 'store'])->name("transaction.store");
    Route::get('/', [TransactionController::class, 'index'])->name("transaction.index");
    Route::post('/', [TransactionController::class, 'create'])->name("transaction.create");
});

route::middleware('auth')->prefix('transfer')->group(function () {
    Route::get('/store', [TransferController::class, 'store'])->name("transfer.store");
    Route::post('/', [TransferController::class, 'create'])->name("transfer.create");
});


Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
//Route::get('/reports',[ReportController::class,'index'])->middleware('auth');
Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');
