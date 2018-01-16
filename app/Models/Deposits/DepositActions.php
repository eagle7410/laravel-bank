<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositActions extends Model
{
    const ALIAS_CREATE       = 'create';
    const ALIAS_INCOME       = 'income';
    const ALIAS_STOPPED      = 'stopped';
    const ALIAS_VERIFICATION = 'verification';
    const ALIAS_ACTIVED      = 'actived';
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
    public static function ActionActivedId()
    {
        return self::where('alias', self::ALIAS_ACTIVED)->first()->id;
    }

    /**
     * @return mixed
     */
    public static function ActionStoppedId()
    {
        return self::where('alias', self::ALIAS_STOPPED)->first()->id;
    }

    /**
     * @return mixed
     */
    public static function ActionVerificationId()
    {
        return self::where('alias', self::ALIAS_VERIFICATION)->first()->id;
    }

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

    public static function listLabel()
    {
        $list = [];
        $data = self::select('id', 'name')->get()->toArray();

        if (empty($data)) {
            return $list;
        }

        array_map(function ($item) use(&$list) {
            $list[$item['id']] = $item['name'];
        }, $data);

        return $list;
    }
}
