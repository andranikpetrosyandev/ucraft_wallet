<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\CreateWalletRequest;
use App\Services\Core\TransactionService;
use App\Services\Core\Wallet\CreateWalletParams;
use App\Services\Core\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    private WalletService $walletService;
    private TransactionService $transactionService;
    private int $userId;

    public function __construct(WalletService $walletService, TransactionService $transactionService)
    {
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;
        $this->middleware('auth');


    }

    public function index(Request $request)
    {
        $wallets = $this->walletService->listByUserId($this->userId);

        return view('wallet.index', ['wallets' => $wallets]);
    }

    public function single(Request $request, $id)
    {
        $wallet = $this->walletService->getById($id);
        if (! Gate::allows('view', $wallet)) {
            abort(403);
        }
        $records = $this->transactionService->getByWalletId($id);
        return view('wallet.single', ['wallet' => $wallet, 'records' => $records]);
    }

    public function store()
    {
        return view('wallet.store');
    }

    public function create(CreateWalletRequest $request)
    {

        $wallet = $this->walletService->create(new CreateWalletParams(
            $request->get('wallet_name'),
            $request->get('wallet_type'),
            Auth::user()->id
        ));
        return redirect()->route('home');

    }

    public function destroy(Request $request, $id)
    {
        Gate::allows('delete', $this->walletService->getById($id));
        $this->walletService->destroy($id);
        return redirect()->route('home');
    }


}
