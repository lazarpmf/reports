<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReportNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Novi izvještaj objavljen.')
                    ->action('Pogledajte sve izvještaje', url('/reports'))
                    ->line('Hvala što koristite aplikaciju!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
