<?php

namespace App\Models\Deposits;

use Illuminate\Database\Eloquent\Model;

class DepositStatuses extends Model
{
    const ALIAS_ACTIVE = 'active';
    const ALIAS_STOP= 'stopped';
    const ALIAS_VERIFICATION = 'verification';
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'deposit_statuses';
    /**
    **
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'alias', 'desc',
    ];

    public static function StatusActiveId()
    {
        return self::where('alias', self::ALIAS_ACTIVE)->first()->id;
    }

    public static function StatusStopId()
    {
        return self::where('alias', self::ALIAS_STOP)->first()->id;
    }

    public static function StatusVerificationId()
    {
        return self::where('alias', self::ALIAS_VERIFICATION)->first()->id;
    }

    public static function listIdAlias()
    {
        $list = [];
        $data = self::select('id', 'alias')->get()->toArray();

        if (empty($data)) {
            return $list;
        }

        array_map(function ($item) use(&$list) {
            $list[$item['id']] = $item['alias'];
        }, $data);

        return $list;
    }
}
