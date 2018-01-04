<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    /*
    * @var bool
    */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'deposit_history';
}
