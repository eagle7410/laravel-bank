<?php

namespace App\Models\Deposits;

use App\User;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deposits extends Model
{
    /**
     * @var string
     */
    protected $table = 'deposits';
    /**
     **
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'sum', 'percent', 'user_id', 'start_at', 'comment'
    ];

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
        $income = DateTime::createFromFormat('Y/m/d', $date);
        $income->modify('+1 month');

        return $income->format('Y/m/d');
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
        $sunBefore = $this->sum;

        $this->sum += $income;
        $this->income_at = $this->nextIncome($this->income_at);
        $userId = Auth::id() || 0;

        $this->created_by = $userId;
        $this->updated_by = $userId;

        $this->save();

        $history = new DepositHistory();

        $history->deposit_id = $this->id;
        $history->sum_before = $sunBefore;
        $history->sum_after = $this->sum;
        $history->created_by = $userId;
        $history->created_at = $this->created_at;
        $history->deposit_action_id = DepositActions::ActionIncomeId();

        if ($comment !== null) {
            $history->comment = $comment;
        }

        $history->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(DepositHistory::class, 'deposit_id', 'id');
    }

    public function latestHistory()
    {
        return $this->hasOne(DepositHistory::class,'deposit_id', 'id')->orderBy('id', 'desc')->latest();
    }

    public function createInfo()
    {
        return $this->belongsTo(DepositHistory::class, 'id', 'deposit_id')->where('deposit_action_id', DepositActions::ActionCreateId());
    }
}
