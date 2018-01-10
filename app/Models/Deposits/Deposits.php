<?php

namespace App\Models\Deposits;


use DateTime;

use Illuminate\Support\Facades\Auth;

class Deposits extends DepositsBase
{
    /**
     * @param array $data
     *
     * @return Deposits
     */
    protected function create(array $data)
    {

        $deposit = new Deposits();
        $deposit->fill($data);

        $deposit->income_at = $this->nextIncome($deposit->start_at);
        $userId = Auth::id() || 0;

        $deposit->created_by = $userId;
        $deposit->updated_by = $userId;
        $deposit->status_id  = DepositStatuses::StatusActiveId();

        $deposit->save();

        $history = new DepositHistory();

        $history->deposit_id = $deposit->id;
        $history->sum_before = 0;
        $history->sum_after = $deposit->sum;
        $history->created_by = $userId;
        $history->created_at = $deposit->created_at;
        $history->deposit_action_id = DepositActions::ActionCreateId();

        $history->save();

        return $deposit;
    }

    /**
     * @param string $date
     *
     * @return string
     */
    private function nextIncome(string $date)
    {
        $income = DateTime::createFromFormat(
            $this->getFormatForDateString($date),
            $date
        );

        $income->modify('+1 month');

        return $income->format('Y/m/d');
    }

    /**
     * @param string $date
     *
     * @return string
     */
    private function getFormatForDateString($date)
    {
        switch (strlen($date)) {
            case 19:
                return 'Y-m-d H:i:s';
            default:
                return 'Y/m/d';
        }
    }
    /**
     * @param DateTime $date
     *
     * @return mixed
     */
    public static function forIncome(\DateTime $date)
    {
        return Deposits::where('status_id', DepositStatuses::StatusActiveId())
            ->where('income_at', '=', $date->format('Y/m/d'))
            ->with('createInfo')
            ->get();
    }

    public function addIncome(float $income, $comment = null)
    {
        $this->sum += $income;
        $this->income_at = $this->nextIncome($this->income_at);
        $userId = Auth::id() || 0;

        $this->updated_by = $userId;

        $history = new DepositHistory();

        $history->deposit_id = $this->id;
        $history->sum_before = $this->original['sum'];
        $history->sum_after = $this->sum;
        $history->created_by = $userId;
        $history->created_at = $this->created_at;
        $history->deposit_action_id = DepositActions::ActionIncomeId();

        if ($comment !== null) {
            $history->comment = $comment;
        }

        $history->save();
        $this->save();
    }
}
