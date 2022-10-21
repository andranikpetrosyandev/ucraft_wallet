<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransferRequest;
use App\Services\Core\TransactionService;
use App\Services\Core\Transfer\CreateTransferParams;
use App\Services\Core\Transfer\InternalTransfer;
use App\Services\Core\TransferService;
use App\Services\Core\WalletService;
use Illuminate\Support\Facades\Auth;

class TransferController
{
    private WalletService $walletService;
    private TransactionService $transactionService;
    private TransferService $transferService;

    public function __construct(WalletService $walletService, TransferService $transferService, TransactionService $transactionService)
    {
        $this->walletService = $walletService;
        $this->transferService = $transferService;
        $this->transactionService = $transactionService;

    }

    public function store()
    {
        $wallets = $this->walletService->listByUserId(Auth::user()->id);
        return view('transfer.store', ['wallets' => $wallets]);
    }

    public function create(CreateTransferRequest $request)
    {
        $this->transferService->create(new CreateTransferParams(
            $request->input('from_wallet_id'),
            $request->input('to_wallet_id'),
            (float)$request->input('amount')
        ));
        return redirect()->route('home');

    }
}
