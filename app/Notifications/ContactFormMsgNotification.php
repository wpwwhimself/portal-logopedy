<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormMsgNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public array $data,
    ) {
        $this->data = $data;
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
        $sender = [
            "name" => $this->data["name"],
            "company" => $this->data["company"],
        ];
        $sender = implode(" | ", array_filter($sender));

        $contact_data = [
            "email" => $this->data["email"],
            "phone" => $this->data["phone"],
        ];
        $contact_data = implode(" / ", array_filter($contact_data));

        return (new MailMessage)
            ->subject("Nowa wiadomość z formularza kontaktowego")
            ->line("Otrzymaliśmy nową wiadomość poprzez formularz kontaktowy.")
            ->line("Nadawca: $sender")
            ->line("Tresć wiadomości: " . $this->data["message_content"])
            ->line("Dane kontaktowe: $contact_data");
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
