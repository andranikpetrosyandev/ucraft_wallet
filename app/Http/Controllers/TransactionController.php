<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Services\Core\Transaction\CreateTransactionParams;
use App\Services\Core\TransactionService;
use App\Services\Core\WalletService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private WalletService $walletService;
    private TransactionService $transactionService;

    public function __construct(WalletService $walletService, TransactionService $transactionService)
    {
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;

    }

    public function index()
    {
        $transactions = $this->transactionService->getByUserId(Auth::user()->id);
        return view('transaction.index', ['transactions' => $transactions]);
    }

    public function store(Request $request, int $walletId = null)
    {
        $wallets = $this->walletService->listByUserId(Auth::user()->id);
        return view('transaction.store', ['wallets' => $wallets, 'wallet_id' => $walletId]);
    }

    public function create(CreateTransactionRequest $request)
    {
        $transaction = $this->transactionService->create(new CreateTransactionParams(
            $request->get('type'),
            (int)$request->get('wallet_id'),
            (float)$request->get('amount')
        ));

        return redirect()->route('wallet.single', (int)$request->get('wallet_id'));

    }


}
