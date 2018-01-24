<?php

namespace Tests\Unit;

use App\Models\Deposits\DepositActions;
use App\Models\Deposits\Deposits;
use App\Services\IncomeService;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Artisan;

class DispositHistoryGetTest extends \Illuminate\Foundation\Testing\TestCase
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

        $date = DateTime::createFromFormat('Y-m-d', '2018-02-01');

        $incomeService = new IncomeService();
        $incomeService->byDate($date)->addIncome();
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testGetHisroty()
    {
        $nowDt = new DateTime();

        $res = $this->call('GET', 'deposit-history/d1');
        $res->assertJson(array (
            'actions' =>
                array (
                    1 => 'Create',
                    2 => 'Stopped',
                    3 => 'On verification',
                    4 => 'Add income',
                ),
            'history' =>
                array (
                    0 =>
                        array (
                            'action' => '4',
                            'comment' => NULL,
                            'sum_before' => '1000.0',
                            'sum_after' => '1250.0',
                            'date_action' =>  $nowDt->format('Y/m/d'),
                        ),
                    1 =>
                        array (
                            'action' => '1',
                            'comment' => NULL,
                            'sum_before' => '0.0',
                            'sum_after' => '1000.0',
                            'date_action' => $nowDt->format('Y/m/d'),
                        ),
                ),
            'status' => '1',
            'sum' => '1250.0',
        ));
    }
}

