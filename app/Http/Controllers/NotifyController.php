<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Notify\NotifyBaseModel;
use Illuminate\Http\Request;

class NotifyController extends AuthBaseController
{
    public function isRead(Request $request)
    {
        $data = $request->validate([
            'id'  => 'required|exists:notifications',
        ]);

        $notify = NotifyBaseModel::find($data['id']);
        $notify->read_at = DateHelper::nowForDb();
        $notify->save();

        return $notify;
    }
}
