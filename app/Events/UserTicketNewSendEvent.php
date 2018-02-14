<?php

namespace App\Events;

use App\Helpers\GravatarHelper;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserTicketNewSendEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;
    public $data;

    /**
     * UserAddDepositIncomeEvent constructor.
     *
     * @param $ticket
     * @param $send
     */
    public function __construct($ticket, $send)
    {
        $this->user = auth()->user();
        /** @var User $authorSend */
        $authorSend = User::find($send->created_by);

        $this->data     = [
            'ticket' => $ticket,
            'send'   => $send,
            'author' => [
                'name_last'  => $authorSend->name_first(),
                'name_first' => $authorSend->name_last(),
                'avatar'     => GravatarHelper::getUrl($authorSend->email)
            ],
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->data['ticket']['user_id']}.tickets");
    }
}
