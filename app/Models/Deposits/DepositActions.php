<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositActions extends Model
{
    const ALIAS_CREATE = 'create';
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

    public static function ActionCreateId()
    {
        return self::where('alias', self::ALIAS_CREATE)->first()->id;
    }
}
