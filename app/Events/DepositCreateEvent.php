<?php

namespace App\Events;

use App\Models\Deposits\DepositsBase;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DepositCreateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var User|null
     */
    public $user;
    /**
     * @var DepositsBase
     */
    public $data;

    /**
     * DepositCreateEvent constructor.
     *
     * @param $deposit
     * @param null|object $user
     */
    public function __construct($deposit, $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->data = $deposit;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('deposits');
    }
}
