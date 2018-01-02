<?php

use Illuminate\Database\Seeder;
use App\Models\Deposits\DepositStatuses;

class DepositStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DepositStatuses::count();

        if ($count === 0) {
            DepositStatuses::whereIn('id', [1,2,3])->delete();

            $arStatuses = [
                [
                    'name' => 'Active',
                    'alias' => 'active'
                ],
                [
                    'name' => 'Stopped',
                    'alias' => 'stopped'
                ],
                [
                    'name' => 'On verification',
                    'alias' => 'verification'
                ],
            ];

            foreach ($arStatuses as $data) {
                \Illuminate\Support\Facades\DB::table('deposit_statuses')->insert($data);
            }
        }
    }
}
