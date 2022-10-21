<?php

namespace App\Services\Core\Transaction;

use App\Models\TransactionType;

class CreateTransactionParams
{

    private string $type;
    private int $walletId;
    private float $amount;

    /**
     * @param TransactionType $type
     * @param int $walletId
     * @param float $amount
     */
    public function __construct(string $type, int $walletId, float $amount)
    {
        $this->type = $type;
        $this->walletId = $walletId;
        $this->amount = $amount;
    }

    /**
     * @return TransactionType
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWalletId(): int
    {
        return $this->walletId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }


}
