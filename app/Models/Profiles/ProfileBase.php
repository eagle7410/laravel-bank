<?php

namespace App\Models\Profiles;

use App\Traits\Models\CreatedBy;
use App\Traits\Models\UpdatedBy;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfileBase
 * @package App\Models\Profile
 * @property int id
 * @property string name_first
 * @property string name_middle
 * @property string name_last
 * @property string desc
 */
class ProfileBase extends Model
{
    const TABLE_NAME = 'profiles';

    use UpdatedBy;

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
        'name_first',
        'name_middle',
        'name_last',
        'user_id',
        'desc',
        'post'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
