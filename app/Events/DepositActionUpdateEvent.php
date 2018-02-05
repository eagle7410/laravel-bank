<?php

namespace App\Events;

use App\Models\Deposits\DepositActions;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DepositActionUpdateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var User|null
     */
    public $user;
    /**
     * @var DepositActions
     */
    public $data;

    /**
     * DepositStatusCreateEvent constructor.
     *
     * @param $action
     * @param null $user
     */
    public function __construct($action, $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->data = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('deposit-actions');
    }
}
