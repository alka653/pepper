<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangePassword extends Notification{
    public function via($notifiable){
        return ['mail'];
    }
    public function toMail($notifiable){
        return (new MailMessage)
            ->subject('Cambio de contraseña')
            ->action('Cambiar contraseña', route('password.reset.token', $notifiable->remember_token));
    }
}