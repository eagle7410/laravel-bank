<?php

namespace App\Http\Controllers;

use App\Models\Deposits\DepositsStats;
use App\User;

class DepositsStatsController extends AuthBaseController
{
    public function index()
    {
        if ($this->user->hasRole(User::ROLE_EMPLOYEE)) {
            return DepositsStats::total();
        } else if ($this->user->hasRole(User::ROLE_CLIENT)) {
            return DepositsStats::total($this->user->id);
        }else{
            abort(403, 'Access denied');
        }
    }
}
