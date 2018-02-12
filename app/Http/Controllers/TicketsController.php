<?php

namespace App\Http\Controllers;

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


        return Tickets::createWithFistMessage($data);
    }

    public function opened()
    {
        if ($this->user->hasRole(User::ROLE_EMPLOYEE)) {
            return Tickets::opened();
        } elseif ($this->user->hasRole(User::ROLE_CLIENT)) {
            return Tickets::openedUser($this->user->id);
        } else {
            return abort(403);
        }
    }

    public function dialog(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:tickets',
        ]);

        if (
            $this->user->hasRole(User::ROLE_EMPLOYEE) ||
            $this->user->hasRole(User::ROLE_CLIENT)
        ) {
            /** @var Tickets $ticket */
            $ticket = Tickets::find($data['id']);

            if (
                $this->user->hasRole(User::ROLE_CLIENT) &&
                $this->user->id !== $ticket->user_id
            ) {
                return abort(403);
            }

            return $ticket->dialogWithUsers();
        } {
            return abort(403);
        }
    }
}
