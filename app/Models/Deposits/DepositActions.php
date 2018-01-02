<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositActions extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'deposit_actions';
    /**
     **
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'desc',
    ];
}
