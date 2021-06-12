<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramPushNotification extends Notification
{
    use Queueable;

    /**
     * @var Article
     */
    private $article;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $chatId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->chatId = config('services.telegram-bot-api.chatId');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }


    public function toTelegram($notifiable)
    {
        $article = $this->article;
        $url = route('articles.show', ['article' => $article]);

        return TelegramMessage::create()
            ->to($this->chatId)
            ->view('notification.telegram-push', ['article' => $article])
            ->button('Увидеть статью', $url);
    }

}
