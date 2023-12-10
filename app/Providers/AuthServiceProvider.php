<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Mail\EmailVerification;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Click the button below to verify your email')
            ->action('Verify Email Address', $url);
        });
    }
}
