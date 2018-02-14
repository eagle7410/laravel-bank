<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 11.02.18
 * Time: 15:09
 */

namespace App\Models\Tickets;

use App\Events\TicketNewSendEvent;
use App\Events\UserTicketNewSendEvent;
use App\Helpers\DateHelper;
use App\Helpers\GravatarHelper;
use App\Models\Profiles\ProfileBase;
use App\User;

class Tickets extends TicketsBase
{
    /**
     * @param array $data
     *
     * @return Tickets
     */
    public static function createWithFistMessage(array $data): Tickets
    {
        $ticket = self::create($data);
        $ticket->save();

        $dialogSend = new TicketDialogBase;
        $dialogSend->fill($data);

        $ticket->dialog()->save($dialogSend);

        return $ticket;
    }
    
    public static function openedUser(int $userId)
    {
        return self::where('user_id', $userId)
            ->whereNull('closed_at')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function opened()
    {
        return self::whereNull('closed_at')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function checkAccessAndGet(int $id, User $user)
    {
        if ($user->hasRole(User::ROLE_EMPLOYEE)) {
            return self::find($id);
        }

        $ticket = self::find($id);

        return $ticket->user_id == $user->id ? $ticket : null;
    }

    public function dialogWithUsers()
    {
        $tableUser    = User::TABLE_NAME;
        $tableProfile = ProfileBase::TABLE_NAME;
        $tableDialog  = TicketDialogBase::TABLE_NAME;

        $users = TicketDialogBase::where('ticket_id', $this->id)
            ->select([$tableDialog.'.created_by', 'email', 'name_first', 'name_last'])
            ->join($tableUser,  $tableDialog .'.created_by', $tableUser .'.id')
            ->leftjoin($tableProfile, $tableDialog .'.created_by', $tableProfile .'.user_id')
            ->groupBy([$tableDialog.'.created_by', 'ticket_id', 'email', 'name_first', 'name_last'])
            ->get()
            ->toArray();

        $users = array_map(function ($user) {
            return [
                'id'         => $user['created_by'],
                'avatar'     => GravatarHelper::getUrl($user['email']),
                'name_first' => $user['name_first'],
                'name_last'  => $user['name_last'],
            ];
        }, $users);

        $dialog = $this->dialog()
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return [
            'users'  => $users,
            'dialog' => $dialog,
        ];
    }

    public function newSend(User $user, array $data)
    {
        $isClient = $user->hasRole(User::ROLE_CLIENT);

        $this->is_read_support = !$isClient;

        $dialogSend = new TicketDialogBase;
        $data['is_support'] = $this->is_read_support;
        $dialogSend->fill($data);

        $this->updated_at = DateHelper::nowForDb();
        $this->save();
        $this->dialog()->save($dialogSend);

        event(new UserTicketNewSendEvent($this, $dialogSend));
        event(new TicketNewSendEvent($this, $dialogSend));

        return $dialogSend;

    }
    
}
