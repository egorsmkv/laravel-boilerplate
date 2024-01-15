<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Route to mine webhook
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user = null) {
            $horizonCanBeAccessed = config('app.horizon.guest_view');
            if ($horizonCanBeAccessed) {
                return true;
            }

            if (!$user) {
                return false;
            }

            return in_array($user->email, [
                config('app.horizon.admins.email_1'),
                config('app.horizon.admins.email_2'),
            ]);
        });
    }
}
