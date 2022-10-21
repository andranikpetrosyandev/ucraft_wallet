<?php

namespace App\Services\Core\Transfer;

class CreateTransferParams
{
    /**
     * @return int
     */
    public function getFromWalletId(): int
    {
        return $this->fromWalletId;
    }

    /**
     * @return int
     */
    public function getToWalletId(): int
    {
        return $this->toWalletId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
    private int $fromWalletId;
    private int $toWalletId;
    private float $amount;

    /**
     * @param int $fromWalletId
     * @param int $toWalletId
     * @param float $amount
     */
    public function __construct(int $fromWalletId, int $toWalletId, float $amount)
    {
        $this->fromWalletId = $fromWalletId;
        $this->toWalletId = $toWalletId;
        $this->amount = $amount;
    }

}
