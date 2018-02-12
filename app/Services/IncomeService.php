<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 10.01.18
 * Time: 21:01
 */

namespace App\Services;

use App\Events\UserAddDepositIncomeEvent;
use App\Helpers\DateHelper;
use App\Models\Deposits\Deposits;
use App\Notifications\SystemEndAddIncome;
use App\User;
use DateTime;

class IncomeService
{
    /**
     * @var []Deposits
     */
    private $deposits;
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var []
     */
    private $stats = [];

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function byDate(\DateTime $date)
    {
        $this->date = $date;
        $this->deposits = Deposits::forIncome($date);

        return $this;
    }

    /**
     * @return int
     */
    public function countDeposit()
    {
        return count($this->deposits);
    }

    /**
     * Add income to deposits.
     *
     * @return $this
     */
    public function addIncome()
    {
        foreach ($this->deposits as $deposit)
        {
            /**
             * @var $deposit Deposits
             */
            $income = $deposit->getIncomeSum();

            $deposit->addIncome($income);

            $this->addStats($income, $deposit);
        }
        
        return $this;
    }

    public function sendNotification()
    {
        if (empty($this->stats)) {
            return $this;
        }

        foreach ($this->stats as $userId => $data)
        {
            /* @var $user User */
            $user = User::find($userId);

            $user->sendNotifyIncome($data);
        }

        $employees = User::role(User::ROLE_EMPLOYEE)->get();

        foreach ($employees as $employee)
        {
            $notify = new SystemEndAddIncome([
                'date' => $this->date->format(DateHelper::DATE_FORMAT_SHOW)
            ]);

            $employee->notify($notify);

            event(new UserAddDepositIncomeEvent($employee, $employee->lastNotify()));
        }

        return $this;
    }

    /**
     * @param float $income
     * 
     * @param Deposits $deposit
     */
    private function addStats(float $income, Deposits $deposit)
    {
        $userId = $deposit->user_id;

        if (empty($this->stats[$userId])) {
            $this->stats[$userId] = [];
        }

        $this->stats[$userId][] = [
            'number' => $deposit->number,
            'income' => $income,
            'income_at' => $this->date->format(DateHelper::DATE_FORMAT_SHOW)
        ];
    }

}
