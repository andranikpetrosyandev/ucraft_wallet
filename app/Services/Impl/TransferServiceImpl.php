<?php

namespace App\Services\Impl;

use App\Http\Requests\CreateTransferRequest;
use App\Models\TransactionType;
use App\Repositories\TransactionRepository;
use App\Services\Core\Transaction\CreateTransactionParams;
use App\Services\Core\TransactionService;
use App\Services\Core\Transfer\CreateTransferParams;
use App\Services\Core\Transfer\TransferStrategy;
use App\Services\Core\TransferService;
use App\Services\Core\WalletService;
use Illuminate\Support\Facades\DB;

class TransferServiceImpl implements TransferService
{
    private TransactionService $transactionService;
    private WalletService $walletService;

    public function __construct(TransactionService $transactionService, WalletService $walletService)
    {
        $this->transactionService = $transactionService;
        $this->walletService = $walletService;
    }


    public function create(CreateTransferParams $params)
    {
        DB::beginTransaction();
        try {
            $this->transactionService->create(
                new CreateTransactionParams(TransactionType::Debit->value, $params->getFromWalletId(), $params->getAmount())
            );
            $this->transactionService->create(
                new CreateTransactionParams(TransactionType::Credit->value, $params->getToWalletId(), $params->getAmount())
            );
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            throw $e;
        }


    }
}
