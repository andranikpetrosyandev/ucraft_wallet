<?php

namespace App\Models;

enum TransactionType: string
{
    case Debit = "debit";
    case Credit = "credit";
}
