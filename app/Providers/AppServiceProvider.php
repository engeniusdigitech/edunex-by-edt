<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Gate::define('manage-staff', function ($user) {
            return $user->isInstituteAdmin();
        });

        \Illuminate\Support\Facades\Gate::define('manage-students', function ($user) {
            return $user->isInstituteAdmin();
        });

        \Illuminate\Support\Facades\Gate::define('manage-attendance', function ($user) {
            return $user->isInstituteAdmin() || $user->isTeacher();
        });

        \Illuminate\Support\Facades\Gate::define('manage-payments', function ($user) {
            return $user->isInstituteAdmin() || $user->isReceptionist();
        });
    }
}
