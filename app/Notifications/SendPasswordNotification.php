<?php

namespace App\Notifications;

use App\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasswordNotification extends Notification
{
    use Queueable;
    private object $user;
    private ?string $url;
    private ?string $password;

    public function __construct(UserModel $user, ?string $url, string $password, string $token)
    {
        $this->user = $user;
        $this->url = "{$url}{$token}";
        $this->password = $password;
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
            ->subject('Filmios')
            ->greeting($this->user->name)
            ->line('Aqui está sua nova senha temporária para acessar sua conta:')
            ->line('senha temporaria: '.$this->password)
            ->action('Acesse já', $this->url ?? 'www.google.com')
            ->line('Se você tiver qualquer problema ou dúvida, não hesite em entrar em contato conosco.')
            ->salutation('Atenciosamente, Equipe de Suporte.');
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
