<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewDonationNotification extends Notification
{
    use Queueable;

    public $donation;

    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New donation')
            ->body('A new donation from "' . $this->donation->donor_name . '" has been reported.')
            ->action('View donations', url('/dashboard/donation/'))
            ->icon('/images/Logo.png');
    }
}
