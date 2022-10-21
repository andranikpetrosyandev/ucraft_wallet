<?php

namespace App\Services\Core;

use App\Services\Core\Transfer\CreateTransferParams;
use App\Services\Core\Transfer\TransferStrategy;

interface TransferService
{
    public function create(CreateTransferParams $transferParams);
}
