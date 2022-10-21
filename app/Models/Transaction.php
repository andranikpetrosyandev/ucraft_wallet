<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = "transactions";

    protected $fillable = ['type','wallet_id','amount'];

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }

}
