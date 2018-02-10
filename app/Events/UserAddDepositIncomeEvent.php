<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserAddDepositIncomeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;
    public $data;

    /**
     * UserAddDepositIncomeEvent constructor.
     *
     * @param User $user
     * @param $data
     */
    public function __construct(User $user, $data)
    {
        $this->user = $user;

        $this->data = [
            'created_at' => $data->created_at,
            'read_at'    => $data->read_at,
            'data'       => $data->data,
            'type'       => $data->type,
            'id'         => $data->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->user->id}.notify");
    }
}
