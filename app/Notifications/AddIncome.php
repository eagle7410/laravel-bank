<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddIncome extends Notification
{
    use Queueable;

    /**
     * @var []
     */
    protected $data = [];

    /**
     * AddIncome constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification'oldAction delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'number'     => $this->data['number'],
            'income'     => $this->data['income'],
            'income_at' => $this->data['income_at'],
        ];
    }
}
