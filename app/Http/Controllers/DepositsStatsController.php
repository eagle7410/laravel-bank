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
        if (auth()->user()->hasRole(User::ROLE_EMPLOYEE)) {
            return DepositsStats::total();
        }
        // TODO: IGOR for client
    }
}
