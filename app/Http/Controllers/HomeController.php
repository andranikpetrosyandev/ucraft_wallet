<?php

namespace App\Http\Controllers;

use App\Services\Core\UserService;
use App\Services\Core\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private WalletService $walletService;
    private UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WalletService $walletService,UserService $userService)
    {
        $this->middleware('auth');
        $this->walletService = $walletService;
        $this->userService =$userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = $this->userService->getUserById(Auth::user()->id);
        $wallets = $this->walletService->listByUserId($user->id);
        $totalPriceForUser = $this->walletService->getTotalAmountForUser($user->id);
        if ($wallets->count() == 0) {
            return redirect()->route('wallet.store');
        }

        return view('home', ['wallets' => $wallets, 'total_price_for_user' => $totalPriceForUser]);
    }
}
