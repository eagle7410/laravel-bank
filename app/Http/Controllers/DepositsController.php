<?php

namespace App\Http\Controllers;

use App\Models\Deposits\Deposits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositsController extends EmployeeController
{
    public function index()
    {
        return Deposits
            ::join('users', 'deposits.user_id', '=', 'users.id')
            ->select([
                'users.email',
                'sum',
                DB::raw("to_char(deposits.income_at::timestamp, 'DD-MM-YYYY') as income"),
                DB::raw("to_char(deposits.start_at::timestamp, 'DD-MM-YYYY') as start"),
                DB::raw("to_char(deposits.created_at::timestamp, 'DD-MM-YYYY') as created"),
                DB::raw("to_char(deposits.updated_at::timestamp, 'DD-MM-YYYY') as updated"),
                'deposits.id',
                'percent',
                'status_id as status' ,
                'number'
            ])
            ->orderBy('deposits.created_at', 'desc')
            ->get()
            ->toArray();
    }
}
