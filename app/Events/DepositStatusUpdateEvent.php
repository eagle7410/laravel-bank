<?php

namespace App\Events;

use App\Models\Deposits\DepositStatuses;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DepositStatusUpdateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var DepositStatuses
     */
    public $data;

    /**
     * DepositStatusCreateEvent constructor.
     *
     * @param $status
     * @param null $user
     */
    public function __construct($status, $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->data = $status;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('deposit-statuses');
    }
}
