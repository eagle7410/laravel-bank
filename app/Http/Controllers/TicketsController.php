<?php

namespace App\Http\Controllers;

use App\Events\TicketCloseEvent;
use App\Events\TicketCreateEvent;
use App\Helpers\DateHelper;
use App\Models\Tickets\Tickets;
use App\User;
use Illuminate\Http\Request;

class TicketsController extends AuthBaseController
{
    public function create(Request $request)
    {
        if (!$this->user->hasRole(User::ROLE_CLIENT)) {
            return abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|min:1',
            'text'  => 'required|string|min:1',
        ]);

        $data['user_id'] = $this->user->id;
        $ticket = Tickets::createWithFistMessage($data);

        event(new TicketCreateEvent($this->user, $ticket));

        return $ticket;
    }

    public function all()
    {
        if ($this->user->hasRole(User::ROLE_EMPLOYEE)) {
            return Tickets::get();
        } elseif ($this->user->hasRole(User::ROLE_CLIENT)) {
            return Tickets::where('user_id', $this->user->id)->get();
        } else {
            return abort(403);
        }
    }

    public function dialog(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:tickets',
        ]);

        /** @var Tickets $ticket */
        if (null === $ticket = Tickets::checkAccessAndGet($data['id'], $this->user)) {
            return abort(403);
        }

        return $ticket->dialogWithUsers();
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'id'   => 'required|exists:tickets',
            'text' => 'required|min:1'
        ]);

        /** @var Tickets $ticket */
        if (null === $ticket = Tickets::checkAccessAndGet($data['id'], $this->user)) {
            return abort(403);
        }

        return $ticket->newSend($this->user, $data);
    }

    public function close(Request $request)
    {
        $data = $request->validate(['id' => 'required|exists:tickets']);

        /** @var Tickets $ticket */
        if (
            $this->user->hasRole(User::ROLE_CLIENT) &&
            null === $ticket = Tickets::checkAccessAndGet($data['id'], $this->user)
        ) {
            return abort(403);
        }

        if (!$ticket->closed_at) {
            $ticket->closed_at = DateHelper::nowForDb();
            $ticket->save();

            broadcast(new TicketCloseEvent($ticket));
        }

        return $ticket;
    }
}
