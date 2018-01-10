<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 10.01.18
 * Time: 21:01
 */

namespace App\Services;

use App\Models\Deposits\Deposits;

class IncomeService
{
    /**
     * @var []Deposits
     */
    private $deposits;

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function byDate(\DateTime $date)
    {
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
     */
    public function addIncome()
    {
        foreach ($this->deposits as $deposit)
        {
            $sumInvest = (float) $deposit->createInfo->sum_after;
            $rate = (float) $deposit->percent / 100;
            $deposit->addIncome($sumInvest * $rate);
        }
    }

}
