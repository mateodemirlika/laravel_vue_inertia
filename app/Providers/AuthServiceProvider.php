<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Listing;
use App\Policies\ListingPolicy;
use App\Policies\NotificationPolicy;
use Notification;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Listing::class => ListingPolicy::class,
        // Notification::class => NotificationPolicy::class
        'Illuminate\Notifications\DatabaseNotification' => 'App\Policies\NotificationPolicy'

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();
        // Gate::policy(Listing::class, ListingPolicy::class);
    }
}
