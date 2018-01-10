<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositActions extends Model
{
    const ALIAS_CREATE = 'create';
    const ALIAS_INCOME = 'income';
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

    /**
     * @return mixed
     */
    public static function ActionCreateId()
    {
        return self::where('alias', self::ALIAS_CREATE)->first()->id;
    }

    /**
     * @return mixed
     */
    public static function ActionIncomeId()
    {
        return self::where('alias', self::ALIAS_INCOME)->first()->id;
    }
}
