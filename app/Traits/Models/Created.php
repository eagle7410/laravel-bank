<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 11.02.18
 * Time: 16:48
 */

namespace App\Traits\Models;

use Illuminate\Support\Facades\Auth;
use App\Helpers\DateHelper;

trait Created
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $userId = Auth::user()->id;

            $model->created_at = DateHelper::nowForDb();
            $model->created_by = $userId;

            if (isset($model->updated_by)) {
                $model->updated_by = $userId;
            }
        });
    }
}
