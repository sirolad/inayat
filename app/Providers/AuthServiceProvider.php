<?php

namespace Inayat\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Inayat\Model' => 'Inayat\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-can-see', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('super-admin-can-see', function ($user) {
            return $user->isSuperAdmin();
        });
    }
}
