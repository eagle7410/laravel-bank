<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Deposits\Deposits;
use App\User;
use Illuminate\Http\Request;
use DateTime;


class DepositController extends AuthBaseController
{
    public function save(Request $request)
    {
        if (!$this->user->hasRole(User::ROLE_EMPLOYEE)) {
            return abort(403, 'Access denied');
        }

        $yesterday = new DateTime();
        $yesterday->setTime(0, 0, 1);
        $yesterday->modify('-1 day');

        $data = $request->validate([
            'number'    => 'required|string|unique:deposits',
            'sum'       => 'required|numeric|min:1',
            'percent'   => 'required|numeric|min:0.01',
            'user_id'   => 'required|numeric|exists:users,id',
            'start_at'  => 'required|date|after:"'.$yesterday->format('Y/m/d').' 00:00:00"',
        ]);

        Deposits::create($data);
    }


    public function changeStatus(Request $request)
    {
        $data = $request->validate([
            'id'     => 'required|numeric|exists:deposits,id',
            'status' => 'required|numeric|exists:deposit_statuses,id',
        ]);

        $deposit = Deposits::find($data['id']);
        $deposit->changeStatus((int) $data['status']);

        return [
            'income' => DateHelper::dateStringToShowFormat($deposit->income_at),
            'updated' => DateHelper::dateStringToShowFormat($deposit->updated_at),
            'status' => $deposit->status_id
        ];
    }
}
