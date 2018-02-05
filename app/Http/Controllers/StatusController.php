<?php

namespace App\Http\Controllers;

use App\Events\DepositStatusCreateEvent;
use App\Events\DepositStatusUpdateEvent;
use App\Models\Deposits\DepositStatuses;
use Illuminate\Http\Request;

class StatusController extends EmployeeBaseController
{
    public function index(Request $request)
    {
        $id = $request->validate(['id' => 'required|integer' ]);

        return DepositStatuses::where('id', $id)->first();
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'alias' => 'required|string|max:100|unique:deposit_statuses',
            'desc'  => 'min:1'
        ]);

        $status = DepositStatuses::create($data);
        $status->save();

        event(new DepositStatusCreateEvent($status));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'id'   => 'required|integer',
            'desc' => 'min:1'
        ]);

        $status = DepositStatuses::where('id', $data['id'])->first();
        $status->fill($data);
        $status->save();

        event(new DepositStatusUpdateEvent($status));
    }
}
