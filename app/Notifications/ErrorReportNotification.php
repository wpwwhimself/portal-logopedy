<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ErrorReportNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $data
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
        $model = "App\\Models\\" . Str::of($this->data["model_name"])->studly()->singular();
        $entity = $model::find($this->data["id"]);

        return (new MailMessage)
            ->subject("Zgłoszenie błędu w danych")
            ->line('Otrzymaliśmy nowe zgłoszenie o błędnych danych.')
            ->line("Ten wpis dotyczy: " . $entity->name . " (" . $model::META['label'] . ")")
            ->line("Opis błędu podany przez użytkownika: " . $this->data["description"])
            ->action('Przejdź do edycji', route("admin-edit-model", ["model" => $this->data["model_name"], "id" => $entity->id]));
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
