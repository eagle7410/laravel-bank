<?php

namespace Tests\Unit;

use App\Models\Deposits\DepositActions;
use App\Models\Deposits\Deposits;
use App\Services\IncomeService;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Artisan;

class IncomeServiceTest extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_CONNECTION=sqlite_testing');

        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');

        Deposits::create([
            'number' => 'd1',
            'sum' => 1000,
            'percent' => 25,
            'user_id' => 1,
            'start_at' => '2018/01/01',
        ]);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIncome()
    {
        $date = DateTime::createFromFormat('Y-m-d', '2018-02-01');

        $incomeService = new IncomeService($date);

        $this->assertTrue($incomeService->countDeposit() === 1, 'Bad count deposit');

        $incomeService->addIncome();

        $deposit = Deposits::with('latestHistory')->first();

        $depositActionIncome = DepositActions::ActionIncomeId();

        $this->assertTrue($deposit->latestHistory->deposit_action_id == $depositActionIncome, 'Bad action history');
        $this->assertTrue($deposit->latestHistory->sum_after == 1250, 'Bad after sum history');
        $this->assertTrue($deposit->sum == 1250, 'Bad sum ');


        $date = DateTime::createFromFormat('Y-m-d', '2018-02-02');

        $incomeService = new IncomeService($date);

        $this->assertTrue($incomeService->countDeposit() === 0, 'Bad count deposit 2018-02-02');

        //Second
        $date = DateTime::createFromFormat('Y-m-d', '2018-03-01');

        $incomeService = new IncomeService($date);

        $this->assertTrue($incomeService->countDeposit() === 1, 'Bad count deposit 2018-03-01');

        $incomeService->addIncome(true);

        $deposit = Deposits::with('latestHistory')->first();

        $depositActionIncome = DepositActions::ActionIncomeId();

        $this->assertTrue($deposit->latestHistory->deposit_action_id == $depositActionIncome, 'Bad action history 2018-03-01');
        $this->assertTrue($deposit->latestHistory->sum_after == 1500, 'Bad after sum history 2018-03-01');
        $this->assertTrue($deposit->latestHistory->sum_before == 1250, 'Bad before sum history 2018-03-01');
        $this->assertTrue($deposit->sum == 1500, 'Bad sum 2018-03-01');
    }
}
