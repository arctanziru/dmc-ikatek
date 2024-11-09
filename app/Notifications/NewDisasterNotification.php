<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewDisasterNotification extends Notification
{
    use Queueable;

    public $disaster;

    public function __construct($disaster)
    {
        $this->disaster = $disaster;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Disaster Reported')
            ->body('A new disaster named "' . $this->disaster->name . '" has been reported.')
            ->action('View Disasters', url('/dashboard/disaster/'))
            ->icon('/images/Logo.png');
    }
}
