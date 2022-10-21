<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Wallet extends Model
{

    use SoftDeletes, HasFactory;

    protected $fillable = ['user_id', 'name', 'type', 'amount'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
