<?php

namespace App\Http\Controllers;

use App\Models\Deposits\Deposits;
use App\User;
use Illuminate\Support\Facades\DB;

class DepositsController extends AuthBaseController
{
    public function index()
    {
        $arSelect = [
            'users.email',
            'sum',
            'deposits.id',
            'percent',
            'status_id as status' ,
            'number'
        ];

        if (app()->environment() !== 'testing') {
            $arSelect = array_merge($arSelect, [
                DB::raw("to_char(deposits.income_at::timestamp, 'DD-MM-YYYY') as income"),
                DB::raw("to_char(deposits.start_at::timestamp, 'DD-MM-YYYY') as start"),
            ]);
        }

        $query = Deposits
            ::join('users', 'deposits.user_id', '=', 'users.id')
            ->orderBy('deposits.created_at', 'desc');

        if ($this->user->hasRole(User::ROLE_CLIENT)) {
            $query->where('deposits.user_id', $this->user->id);
        }

        return $query->select($arSelect)->get()->toArray();
    }
}
