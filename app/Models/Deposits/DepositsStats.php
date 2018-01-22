<?php
namespace App\Models\Deposits;

use Illuminate\Support\Facades\DB;

class DepositsStats extends DepositsBase
{

    protected function create(array $data) {throw new \Error(__METHOD__ . '. Not create');}
    public function save(array $options = []){throw new \Error(__METHOD__ . '. Not save');}

    public static function total(?int $userId = null): array
    {
        $totalSum = self::totalDepositsSum($userId);
        $totalDeposits = self::totalDeposit($userId);

        $counts = self::countsDepositByStatuses($userId);

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

    public static function totalDepositsSum(?int $userId)
    {
        if (empty($userId)) {
            return self::sum('sum');
        }

        return self::where('user_id', $userId)->sum('sum');
    }
    /**
     * @param int|null $userId
     *
     * @return mixed
     */
    protected static function countsDepositByStatuses(?int $userId)
    {
        $query = self::groupBy('status_id')
            ->select(DB::raw('count(id) as deposit_count, status_id'));

        return self::filterByUser($query, $userId)->get();
    }

    /**
     * @param int|null $userId
     *
     * @return mixed
     */
    protected static function totalDeposit(?int $userId)
    {
        $query = DepositHistory::where('deposit_action_id', DepositActions::ActionCreateId());

        return self::filterByUser($query, $userId, true)->sum('sum_after');
    }

    /**
     * @param $query
     * @param int|null $userId
     * @param bool $joinTable
     *
     * @return mixed
     */
    protected static function filterByUser($query ,?int $userId, bool $joinTable = false)
    {
        if (!empty($userId)) {
            if ($joinTable) {
                $query->join(DepositsBase::TABLE_NAME, 'deposit_id', DepositsBase::TABLE_NAME . '.id')
                    ->where(DepositsBase::TABLE_NAME . '.user_id', $userId);
            } else {
                $query->where('user_id', $userId);
            }
        }

        return $query;
    }
}
