<?php

namespace App\Http\Controllers;

use App\Models\Deposits\DepositActions;
use Illuminate\Http\Request;

class ActionController extends EmployeeController
{
    public function index(Request $request)
    {
        $id = $request->validate(['id' => 'required|integer' ]);

        return DepositActions::where('id', $id)->first();
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'alias' => 'required|string|max:100|unique:deposit_statuses|unique:deposit_statuses',
            'desc'  => 'min:1'
        ]);

        $status = DepositActions::create($data);
        $status->save();
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'id' => 'required|integer',
            'desc'  => 'min:1'
        ]);

        $status = DepositActions::where('id', $data['id'])->first();
        $status->fill($data);
        $status->save();
    }
}
