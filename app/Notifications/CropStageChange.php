<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CropStageChange extends Notification
{
    use Queueable;

    private $crop;
    private $newStage;

    public function __construct($crop, $newStage)
    {
        $this->crop = $crop;
        $this->newStage = $newStage;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Crop Stage Update')
            ->line("Your crop {$this->crop->crop_name} has entered the {$this->newStage} stage.")
            ->action('View Crop', url("/crops/{$this->crop->id}"))
            ->line('Thank you for using our application!');
    }
}