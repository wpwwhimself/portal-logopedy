<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterSubscribedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Witamy w naszym newsletterze!")
            ->line("Cieszymy się, że chcesz otrzymywać od nas informacje odnośnie kursów i szkoleń logopedycznych.")
            ->line("Jak tylko będziemy mieli dla Ciebie najnowsze o nich informacje, damy Ci znać!")
            ->line("Jeśli nie chcesz otrzymywać naszego newslettera lub otrzymaliśmy Twój adres email przez przypadek, użyj przycisku poniżej, żeby wypisać się z newslettera.")
            ->action("Wypisz się z newslettera", route("newsletter-form", ["mode" => "unsubscribe"]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
