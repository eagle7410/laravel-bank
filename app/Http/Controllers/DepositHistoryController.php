<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Deposits\DepositActions;
use App\Models\Deposits\Deposits;
use DateTime;

class DepositHistoryController extends Controller
{
    public function index($number)
    {
        $depositWithHistory = Deposits::where('number', $number)
            ->with(['history' => function($q) {
                $q->orderBy('id', 'desc');
            }])
            ->first();

        $responseData = [
            'actions' => DepositActions::listLabel(),
            'history' => [],
            'status'  => $depositWithHistory->status_id,
            'sum'     => $depositWithHistory->sum,
        ];

        foreach ($depositWithHistory->history as $history) {
            $createdDt = DateTime::createFromFormat(DateHelper::getDateFormat($history->created_at), $history->created_at);

            $responseData['history'][] = [
                'action'      => $history->deposit_action_id,
                'comment'     => $history->comment,
                'sum_before'  => $history->sum_before,
                'sum_after'   => $history->sum_after,
                'date_action' => $createdDt->format(DateHelper::DATE_FORMAT_RESPONSE)
            ];
        }

        return $responseData;
    }
}
