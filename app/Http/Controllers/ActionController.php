<?php

namespace App\Http\Controllers;

use App\Events\DepositActionCreateEvent;
use App\Events\DepositActionUpdateEvent;
use App\Models\Deposits\DepositActions;
use Illuminate\Http\Request;

class ActionController extends EmployeeBaseController
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
            'alias' => 'required|string|max:100|unique:deposit_actions',
            'desc'  => 'min:1'
        ]);

        $action = DepositActions::create($data);
        $action->save();

        event(new DepositActionCreateEvent($action));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'id' => 'required|integer',
            'desc'  => 'min:1'
        ]);

        $action = DepositActions::where('id', $data['id'])->first();
        $action->fill($data);
        $action->save();

        event(new DepositActionUpdateEvent($action));
    }
}
