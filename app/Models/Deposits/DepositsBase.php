<?php

namespace App\Models\Deposits;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DepositsBase extends Model
{
    const TABLE_NAME = 'deposits';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;
    /**
     **
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'sum', 'percent', 'user_id', 'start_at', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(DepositHistory::class, 'deposit_id', 'id');
    }

    public function latestHistory()
    {
        return $this->hasOne(DepositHistory::class,'deposit_id', 'id')->orderBy('id', 'desc')->latest();
    }

    public function createInfo()
    {
        return $this->belongsTo(DepositHistory::class, 'id', 'deposit_id')->where('deposit_action_id', DepositActions::ActionCreateId());
    }
}
