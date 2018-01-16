<?php

namespace App\Http\Controllers;

use App\Models\Deposits\DepositsStats;
use App\User;
use Illuminate\Http\Request;

class DepositsStatsController extends Controller
{
    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole(User::ROLE_EMPLOYEE)) {
            return DepositsStats::total();
        } else if ($user->hasRole(User::ROLE_CLIENT)) {
            echo 'DOIt';
            // TODO: IGOR
        }else{
            abort(403, 'Access denied');
        }
    }
}
