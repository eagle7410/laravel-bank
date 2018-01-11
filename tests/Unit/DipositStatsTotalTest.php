<?php
namespace Tests\Unit;

use App\Models\Deposits\DepositActions;
use App\Models\Deposits\Deposits;
use App\Models\Deposits\DepositsStats;
use App\Models\Deposits\DepositStatuses;
use App\Services\IncomeService;
use Illuminate\Support\Facades\Artisan;
use DateTime;

class DipositStatsTotalTest extends \Illuminate\Foundation\Testing\TestCase
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

        $arDeposits = [
            [
                'number' => 'd1',
                'sum' => 1000,
                'percent' => 25,
                'user_id' => 1,
                'start_at' => '2018/01/01',
            ],
            [
                'number' => 'd2',
                'sum' => 1000,
                'percent' => 25,
                'user_id' => 1,
                'start_at' => '2018/01/01',
            ],
            [
                'number' => 'd3',
                'sum' => 2000,
                'percent' => 25,
                'user_id' => 1,
                'start_at' => '2018/01/01',
            ],
            [
                'number' => 'd4',
                'sum' => 2000,
                'percent' => 50,
                'user_id' => 1,
                'start_at' => '2018/01/01',
            ],
            [
                'number' => 'd5',
                'sum' => 4000,
                'percent' => 50,
                'user_id' => 1,
                'start_at' => '2018/01/01',
            ],
        ];

        foreach ($arDeposits as $depositData)
            Deposits::create($depositData);

        $incomeService = new IncomeService();
        $incomeService->byDate(DateTime::createFromFormat('Y-m-d', '2018-02-01'))
            ->addIncome();

        /* @var Deposits $depositForStop */
        $depositForStop = Deposits::where('number', 'd5')->first();
        $depositForStop->stopped('For test');

        /* @var Deposits $depositForVerification */
        $depositForVerification = Deposits::where('number', 'd4')->first();
        $depositForVerification->toVerification();

    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testIncomeWithDifferentStatus()
    {
        $incomeService = new IncomeService();

        $incomeService
            ->byDate(DateTime::createFromFormat('Y-m-d', '2018-03-01'))
            ->addIncome();

        $this->assertTrue($incomeService->countDeposit() === 3, 'Bad count income');
    }

    public function testDepositStoppedVerification()
    {
        /* @var Deposits $depositForStop */
        $depositForStop = Deposits::where('number', 'd5')->with('latestHistory')->first();
        /* @var Deposits $depositForVerification */
        $depositForVerification = Deposits::where('number', 'd4')->with('latestHistory')->first();

        $this->assertTrue($depositForStop->status_id == DepositStatuses::StatusStopId(), 'Deposit d5 bad status');
        $this->assertTrue($depositForStop->latestHistory->comment === 'For test', 'Deposit d5 bad comment in history');
        $this->assertTrue($depositForStop->latestHistory->deposit_action_id == DepositActions::ActionStoppedId(), 'Deposit d5 bad action in history');

        $this->assertTrue($depositForVerification->status_id == DepositStatuses::StatusVerificationId(), 'Deposit d4 bad status');
        $this->assertTrue($depositForVerification->latestHistory->comment === null, 'Deposit d4 bad comment in history');
        $this->assertTrue($depositForVerification->latestHistory->deposit_action_id == DepositActions::ActionVerificationId(), 'Deposit d4 bad action in history');
    }

    public function testDepositStatsTotal()
    {
        $incomeService = new IncomeService();

        $incomeService
            ->byDate(DateTime::createFromFormat('Y-m-d', '2018-03-01'))
            ->addIncome();

        $stats = DepositsStats::total();

        $this->assertEquals($stats, [
            "totalSum" => "15000.0",
            "totalDeposits" => "10000.0",
            "depositsCountActive" => "3",
            "depositsCountStopped" => "1",
            "depositsCountVerification" => "1",
        ], 'Bad total stats');
    }
}
