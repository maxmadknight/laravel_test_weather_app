<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeatherAlertNotification extends Notification
{
    use Queueable;

    protected $city;
    protected $conditions;

    public function __construct(string $city, array $conditions)
    {
        $this->city = $city;
        $this->conditions = $conditions;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Weather Alert for ' . $this->city)
            ->line("Warning! The weather in {$this->city} has exceeded your threshold.")
            ->line('Precipitation: ' . $this->conditions['precipitation'] . ' mm')
            ->line('UV Index: ' . $this->conditions['uv_index']);
    }
}
