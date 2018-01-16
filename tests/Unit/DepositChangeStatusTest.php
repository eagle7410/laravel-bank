<?php
namespace Tests\Unit;

use App\Models\Deposits\DepositActions;
use App\Models\Deposits\Deposits;
use App\Models\Deposits\DepositStatuses;
use Illuminate\Support\Facades\Artisan;

class DepositChangeStatusTest extends \Illuminate\Foundation\Testing\TestCase
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

    public function testToVerification()
    {
        /* @var Deposits $deposit*/
        $deposit = Deposits::find(1);
        $deposit->toVerification();

        $deposit = Deposits::with('latestHistory')->first();
        $this->assertTrue(DepositStatuses::StatusVerificationId() == $deposit->status_id, 'Bad deposit status');
        $this->assertTrue(DepositActions::ActionVerificationId() == $deposit->latestHistory->deposit_action_id, 'Bad deposit history');
    }

    public function testStopped()
    {
        /* @var Deposits $deposit*/
        $deposit = Deposits::find(1);
        $deposit->stopped();

        $deposit = Deposits::with('latestHistory')->first();
        $this->assertTrue(DepositStatuses::StatusStopId() == $deposit->status_id, 'Bad deposit status');
        $this->assertTrue(DepositActions::ActionStoppedId() == $deposit->latestHistory->deposit_action_id, 'Bad deposit history');
    }

    public function testActived()
    {
        /* @var Deposits $deposit*/
        $deposit = Deposits::find(1);
        $deposit->stopped();
        $deposit->actived();

        $deposit = Deposits::with('latestHistory')->first();
        $this->assertTrue(DepositStatuses::StatusActiveId() == $deposit->status_id, 'Bad deposit status');
        $this->assertTrue(DepositActions::ActionActivedId() == $deposit->latestHistory->deposit_action_id, 'Bad deposit history');
    }
}
