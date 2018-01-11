<?php
namespace App\Models\Deposits;

use Illuminate\Support\Facades\DB;

class DepositsStats extends DepositsBase
{

    protected function create(array $data) {throw new \Error(__METHOD__ . '. Not create');}
    public function save(array $options = []){throw new \Error(__METHOD__ . '. Not save');}

    public static function total()
    {
        $totalSum = self::sum('sum');
        $totalDeposits = DepositHistory::where('deposit_action_id', DepositActions::ActionCreateId())->sum('sum_after');

        $counts = self::groupBy('status_id')
            ->select(DB::raw('count(id) as deposit_count, status_id'))
            ->get();

        $listStatuses = DepositStatuses::listIdAlias();

        $depositsCountActive       = 0;
        $depositsCountStopped      = 0;
        $depositsCountVerification = 0;

        foreach ($counts as $data) {
            switch ($listStatuses[$data['status_id']]) {
                case DepositStatuses::ALIAS_ACTIVE:
                    $depositsCountActive = $data['deposit_count'];
                    break;
                case DepositStatuses::ALIAS_STOP:
                    $depositsCountStopped = $data['deposit_count'];
                    break;
                case DepositStatuses::ALIAS_VERIFICATION:
                    $depositsCountVerification = $data['deposit_count'];
                    break;
            }
        }

        return [
            "totalSum"                  => $totalSum,
            "totalDeposits"             => $totalDeposits,
            "depositsCountActive"       => $depositsCountActive,
            "depositsCountStopped"      => $depositsCountStopped,
            "depositsCountVerification" => $depositsCountVerification
        ];

    }
}
