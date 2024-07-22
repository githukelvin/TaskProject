<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class CustomEmailProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $frontendUrl = $this->getFrontendVerificationUrl($url);

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $frontendUrl)
                ->line('If you did not create an account, no further action is required.');
        });
    }

    protected function getFrontendVerificationUrl($url): string
    {
        $queryParams = parse_url($url, PHP_URL_QUERY);
        return config('app.frontend_url') . '/verify-email?' . $queryParams;
    }
}
