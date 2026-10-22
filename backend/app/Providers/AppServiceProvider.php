<?php

namespace App\Providers;

use App\Services\Notifications\EmailNotificationChannel;
use App\Services\Notifications\NotificationChannel;
use App\Services\Notifications\OneSignalNotificationChannel;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('notification.channel.email', static fn () => new EmailNotificationChannel());
        $this->app->bind('notification.channel.push', static fn () => new OneSignalNotificationChannel());

        $this->app->when(\App\Services\Notifications\EmergencyNotificationService::class)
            ->needs('$emailChannel')
            ->give(fn () => app('notification.channel.email'));
        $this->app->when(\App\Services\Notifications\EmergencyNotificationService::class)
            ->needs('$pushChannel')
            ->give(fn () => app('notification.channel.push'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api-auth', static function (Request $request) {
            return Limit::perMinute(10)->by($request->ip().$request->input('email'));
        });

        RateLimiter::for('api-otp', static function (Request $request) {
            return Limit::perMinute(5)->by($request->ip().$request->input('email'));
        });
    }
}
