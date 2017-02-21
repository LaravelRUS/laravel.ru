<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class ConfirmEmailNotification.
 */
class ConfirmEmailNotification extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $user;

    /**
     * @var JWTInterface
     */
    private $jwt;

    /**
     * ConfirmEmailNotification constructor.
     *
     * @param User         $user
     * @param JWTInterface $jwt
     */
    public function __construct(User $user, JWTInterface $jwt)
    {
        $this->user = $user;
        $this->jwt = $jwt;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $token = $this->jwt->encode($this->createToken());

        $action = route('confirmation.confirm', [
            'token' => $token,
        ]);

        return (new MailMessage)
            ->success()
            ->line('Подтвердите свой Email')
            ->action('Подтвердить', $action)
            ->line('Спасибо, что остаётесь с нами!');
    }

    /**
     * @return array
     */
    private function createToken(): array
    {
        return [
            'email' => $this->user->email,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
