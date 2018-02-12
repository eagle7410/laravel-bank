<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 11.02.18
 * Time: 16:03
 */
namespace Tests\Unit;

use App\Models\Tickets\TicketDialogBase;
use App\Models\Tickets\Tickets;
use App\User;
use Illuminate\Support\Facades\Artisan;

class TicketCreateTest extends \Illuminate\Foundation\Testing\TestCase
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

        $user = User::find(1);
        $this->be($user);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testCreate()
    {
        $ticket = Tickets::createWithFistMessage([
            'user_id' => 1,
            'title'   => 'test',
            'text'    => 'first text',
        ]);

        $this->assertArraySubset([
            "is_read_support" => 0,
            "user_id"         => 1,
            "title"           => "test",
            "created_by"      => 1,
            "updated_by"      => 1,
            "id"              => 1,
        ], $ticket->toArray());

        $firstSend = TicketDialogBase::first();

        $this->assertArraySubset([
            "id"         => 1,
            "ticket_id"  => 1,
            "is_support" => 0,
            "text"       => "first text",
            "created_by" => 1,
        ], $firstSend->toArray());
    }
}
