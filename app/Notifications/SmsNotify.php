<?php

namespace App\Notifications;

use App\Channels\EasySms\EasySms;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\EasySms\Message\Message;

class SmsNotify extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @param  array  $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            EasySms::class
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return Message
     */
    public function toSms($notifiable)
    {
        return (new Message())
            ->setContent($this->data['content'] ?? '')
            ->setData($this->data['params'] ?? [])
            ->setTemplate($this->data['template'] ?? '')
            ->setScenes($this->data['scenes'] ?? '');
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
            //
        ];
    }
}
