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
            DepositActions::whereIn('id', [1,2,3,4,5])->delete();

            $arStatuses = [
                [
                    'name' => 'Create',
                    'alias' => DepositActions::ALIAS_CREATE
                ],
                [
                    'name' => 'Stopped',
                    'alias' => DepositActions::ALIAS_STOPPED
                ],
                [
                    'name' => 'On verification',
                    'alias' => DepositActions::ALIAS_VERIFICATION
                ],
                [
                    'name' => 'Add income',
                    'alias' => DepositActions::ALIAS_INCOME
                ],
                [
                    'name' => 'Actived',
                    'alias' => DepositActions::ALIAS_ACTIVED,
                ]
            ];

            foreach ($arStatuses as $data) {
                \Illuminate\Support\Facades\DB::table('deposit_actions')->insert($data);
            }
        }
    }
}
