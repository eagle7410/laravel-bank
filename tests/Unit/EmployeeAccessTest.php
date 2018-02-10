<?php
namespace Tests\Unit;

use App\Models\Notify\NotifyBaseModel;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Tests\Libs\RequestData;

class EmployeeAccessTest extends \Illuminate\Foundation\Testing\TestCase
{

    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_PATCH  = 'PATCH';
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_CONNECTION=sqlite_testing');
        putenv('APP_ENV=testing');

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

        $notice = new NotifyBaseModel();

        $notice->data = 'test';
        $notice->notifiable_id = 1;
        $notice->id = 1;
        $notice->type = self::class;
        $notice->notifiable_type = self::class;
        $notice->save();
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    private function data()
    {
        $now = new \DateTime();

        return (object) [
            'user' => [
                'name'     => 'testClient',
                'email'    => 'client@gmail.com',
                'role'     => User::ROLE_CLIENT,
                'password' => '123456',
            ],
            'status' => [
                'name'  => 'Fake',
                'alias' => 'fake',
                'desc'  => 'd'
            ],
            'profile' => [
                'name_first' => 'TT1',
                'name_last'  => 'SS1',
            ],
            'deposit' => [
                'number' => 'd1',
                'sum' => 1000,
                'percent' => 25,
                'user_id' => 1,
                'start_at' => $now->format('Y/m/d'),
            ],
            'depositChangeStatus' => [
                'id' => 1,
                'status' => 3
            ]
        ];
    }

    public function testAccessControllers()
    {

        $testData = $this->data();
        $reqDeposits = new RequestData('deposits');
        $reqDeposit = new RequestData('deposit',self::METHOD_POST, $testData->deposit);

        $arCheck = [
            new RequestData('home'),
            new RequestData('users'),
            new RequestData('user', self::METHOD_POST, $testData->user),
            new RequestData('statuses'),
            new RequestData('status',null, ['id' => 1]),
            new RequestData('status',self::METHOD_POST, $testData->status),
            new RequestData('status',self::METHOD_PUT, ['id' => 1, 'name' => 'test']),
            new RequestData('actions'),
            new RequestData('profile', self::METHOD_PUT, $testData->profile),
            new RequestData('deposits-stats'),
            $reqDeposits,
            new RequestData('clients'),
            new RequestData('action',null, ['id' => 1]),
            new RequestData('action',self::METHOD_POST, $testData->status),
            new RequestData('action',self::METHOD_PUT, ['id' => 1, 'name' => 'test']),
            $reqDeposit,
            new RequestData('deposit-history/d1'),
            new RequestData('deposit', self::METHOD_PATCH, $testData->depositChangeStatus),
            new RequestData('notify', self::METHOD_PATCH, ['id' => 1]),
        ];

        foreach ($arCheck as $request)
        {
            $response = $this->call($request->method, $request->url, $request->data);

            if ($request->isCall) {
                echo "Response status {$response->getStatusCode()} need {$request->status}\n";
                echo $response->getContent();
                die();
            }

            $this->assertEquals($request->status, $response->getStatusCode(), "Bad status code {$request->method}|{$request->url}");
        }

        $user = User::find(3);
        $this->be($user);

        foreach ($arCheck as $request)
        {
            switch ("{$request->url}@{$request->method}") {
                case 'home@GET':
                case 'profile@PUT':
                case 'deposits@GET':
                case 'deposits-stats@GET':
                case 'deposit-history/d1@GET':
                case 'deposit@'.self::METHOD_PATCH:
                case 'notify@'.self::METHOD_PATCH:
                    break;
                default:
                    $request->status = 403;
            }

            $response = $this->call($request->method, $request->url, $request->data);

            $this->assertEquals(
                $request->status,
                $response->getStatusCode(),
                "Bag access {$request->method}|{$request->url}|{$response->getStatusCode()}"
            );
        }
    }
}
