<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailDigest extends Notification
{
    use Queueable;

    public $articles;
    public $namePeriod;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Collection $articles, string $namePeriod)
    {
        $this->articles = $articles;
        $this->namePeriod = $namePeriod;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Digest Articles')
                    ->markdown('mail.articles-digest', ['articles' => $this->articles, 'namePeriod' => $this->namePeriod]);

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
