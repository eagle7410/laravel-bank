<?php

use App\Models\Deposits\DepositActions;
use Illuminate\Database\Seeder;

class DepositActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = \App\Models\Deposits\DepositActions::count();

        if ($count === 0) {
            DepositActions::whereIn('id', [1,2,3,4])->delete();

            $arStatuses = [
                [
                    'name' => 'Create',
                    'alias' => 'create'
                ],
                [
                    'name' => 'Stopped',
                    'alias' => 'stopped'
                ],
                [
                    'name' => 'On verification',
                    'alias' => 'verification'
                ],
                [
                    'name' => 'Add income',
                    'alias' => 'income'
                ],
            ];

            foreach ($arStatuses as $data) {
                \Illuminate\Support\Facades\DB::table('deposit_actions')->insert($data);
            }
        }
    }
}
