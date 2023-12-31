<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendGoodbyeEmail extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage();
        $message->subject(trans('emails.goodbyeSubject'))
            ->greeting(trans('emails.goodbyeGreeting', ['username' => Auth::User()->name]))
            ->line(trans('emails.goodbyeMessage', ['days' => setting('restore_user_cutoff', 30)]))
            ->action(trans('emails.goodbyeButton'), route('user.reactivate', ['token' => $this->token]))
            ->line(trans('emails.goodbyeThanks'));

        return $message;
    }
}
