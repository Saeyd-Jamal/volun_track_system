<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind('abilities', function() {
            return include base_path('data/abilities.php');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();


        //Authouration
        Gate::before(function ($user, $ability) {
            if($user instanceof User) {
                if($user->super_admin) {
                    return true;
                }
            }
        });
        // the Authorization for Report Page
        // Gate::define('report.view', function ($user) {
        //     if($user instanceof User) {
        //         if($user->roles->contains('role_name', 'report.view')) {
        //             return true;
        //         }
        //         return false;
        //     }
        // });




        // Observe For Models
        User::observe(UserObserver::class);


    }
}
