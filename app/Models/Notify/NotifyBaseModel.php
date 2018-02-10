<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;

class NotifyBaseModel extends Model
{
    const TABLE_NAME = 'notifications';

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
        'read_at'
    ];

}
