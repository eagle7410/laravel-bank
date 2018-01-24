<?php
namespace App\Models\Deposits;

use App\Helpers\DateHelper;
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

        $deposit->income_at = DateHelper::dateAfterMonth($deposit->start_at);
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
     * @param DateTime $date
     *
     * @return mixed
     */
    public static function forIncome(DateTime $date)
    {
        return Deposits::where('status_id', DepositStatuses::StatusActiveId())
            ->where('income_at', '=', $date->format(DateHelper::DATE_FORMAT_RESPONSE))
            ->with('createInfo')
            ->get();
    }

    public function getIncomeSum()
    {
        $sumInvest = (float) $this->createInfo->sum_after;
        $rate = (float) $this->percent / 100;

        return $sumInvest * $rate;
    }

    /**
     * @param float $income
     * @param null|string $comment
     */
    public function addIncome(float $income, ?string $comment = null)
    {
        $this->sum += $income;
        $this->income_at = DateHelper::dateAfterMonth($this->income_at);
        $this->updated_by = Auth::id() || 0;

        $this->saveWithHistory([
            'comment'           => $comment,
            'deposit_action_id' => DepositActions::ActionIncomeId()
        ]);
    }

    /**
     * @param null|string $comment
     */
    public function stopped(?string $comment = null)
    {
        $this->status_id = DepositStatuses::StatusStopId();
        $this->updated_by = Auth::id() || 0;

        $this->saveWithHistory([
            'comment'           => $comment,
            'deposit_action_id' => DepositActions::ActionStoppedId()
        ]);
    }

    /**
     * @param null|string $comment
     */
    public function toVerification(?string $comment = null)
    {
        $this->status_id = DepositStatuses::StatusVerificationId();
        $this->updated_by = Auth::id() || 0;

        $this->saveWithHistory([
            'comment'           => $comment,
            'deposit_action_id' => DepositActions::ActionVerificationId()
        ]);
    }

    /**
     * @param null|string $comment
     */
    public function actived(?string $comment = null)
    {
        $dateDt = new DateTime();

        $statuses = DepositStatuses::listIdAlias();

        switch ($statuses[$this->status_id]) {
            case DepositStatuses::ALIAS_STOP:
            case DepositStatuses::ALIAS_VERIFICATION:
                $incomeAtDt = DateHelper::getDateTimeFromString($this->income_at);

                if ($incomeAtDt->format(DateHelper::DATE_FORMAT_RESPONSE) < $incomeAtDt->format(DateHelper::DATE_FORMAT_RESPONSE)) {
                    $this->income_at = DateHelper::dateAfterMonth($dateDt->format(DateHelper::DATE_FORMAT_DB));
                }

                break;
            default :
                return;
        }

        $this->status_id = DepositStatuses::StatusActiveId();
        $this->updated_by = Auth::id() || 0;

        $this->saveWithHistory([
            'comment'           => $comment,
            'deposit_action_id' => DepositActions::ActionActivedId()
        ]);
    }

    public function changeStatus(int $status, ?string $comment = null)
    {
        $statuses = DepositStatuses::listIdAlias();
        $statusAlias = $statuses[$status];

        switch ($statusAlias) {
            case DepositStatuses::ALIAS_VERIFICATION:
                $this->toVerification($comment);
                break;
            case DepositStatuses::ALIAS_STOP:
                $this->stopped($comment);
                break;
            case DepositStatuses::ALIAS_ACTIVE:
                $this->actived($comment);
        }
    }
    /**
     * @param array $extendData
     *
     * @return DepositHistory
     */
    private function getHistory(array $extendData)
    {
        $history = new DepositHistory();

        $history->deposit_id = $this->id;
        $history->sum_before = $this->original['sum'];
        $history->sum_after  = $this->sum;
        $history->created_by = Auth::id() || 0;
        $now = new DateTime();
        $history->created_at = $now->format(DateHelper::DATE_FORMAT_DB);

        if (empty($extendData['comment']))
            unset($extendData['comment']);

        foreach ($extendData as $key => $val)
            $history->{$key} = $val;

        return $history;
    }

    /**
     * @param array $extendData
     */
    private function saveWithHistory(array $extendData)
    {
        $history = $this->getHistory($extendData);
        $history->save();
        $this->save();
    }
}
