<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 18.01.18
 * Time: 13:05
 */

namespace App\Traits\Models;

use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        });
    }
}
