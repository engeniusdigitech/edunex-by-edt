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
        if (config('app.env') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\Gate::define('manage-principals', function ($user) {
            return $user->isInstituteAdmin() && $user->institute->isSchool();
        });

        \Illuminate\Support\Facades\Gate::define('manage-staff', function ($user) {
            return $user->isInstituteAdmin() || $user->isPrincipal();
        });

        \Illuminate\Support\Facades\Gate::define('manage-students', function ($user) {
            return $user->isInstituteAdmin() || $user->isPrincipal();
        });

        \Illuminate\Support\Facades\Gate::define('manage-attendance', function ($user) {
            return $user->isInstituteAdmin() || $user->isPrincipal() || $user->isTeacher();
        });

        \Illuminate\Support\Facades\Gate::define('manage-payments', function ($user) {
            return $user->isInstituteAdmin() || $user->isReceptionist();
        });

        \Illuminate\Support\Facades\Gate::define('manage-batches', function ($user) {
            return $user->isInstituteAdmin() || $user->isPrincipal();
        });

        \Illuminate\Support\Facades\Gate::define('manage-academics', function ($user) {
            return $user->isInstituteAdmin() || $user->isPrincipal() || $user->isTeacher();
        });
    }
}
