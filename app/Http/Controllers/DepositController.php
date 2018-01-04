<?php

namespace App\Http\Controllers;

use App\Models\Deposits\Deposits;
use Illuminate\Http\Request;
use DateTime;


class DepositController extends EmployeeController
{
    public function save(Request $request)
        {
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
}
