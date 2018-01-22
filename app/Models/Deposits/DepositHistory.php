<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    const TABLE_NAME = 'deposit_history';
    /*
    * @var bool
    */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    public function deposit()
    {
        return $this->belongsTo(DepositsBase::class, 'id', 'deposit_id');
    }

}
