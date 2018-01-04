<?php

namespace App\Models\Deposits;

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

        $income = DateTime::createFromFormat('Y/m/d', $deposit->start_at);
        $income->modify('+1 month');

        $deposit->income_at = $income->format('Y/m/d');
        $userId = Auth::id();

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
}
