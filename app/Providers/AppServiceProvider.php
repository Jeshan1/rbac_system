<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        
        Gate::define('manage-users', function($user){
            Log::info('User role:', ['role' => $user->roles]);
            return $user->roles->contains('name','admin');
        });

        Gate::define('manage-role', function($user){
            return $user->roles->contains('name','reader');
        });
    }
}
