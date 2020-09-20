<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('super_admin', function($user){
            return $user->peran->nama == 'Super Admin';
        });

        Gate::define('dokter', function($user){
            return $user->peran->nama == 'Dokter';
        });

        Gate::define('pengurus_lab', function($user){
            return $user->peran->nama == 'pengurus_lab';
        });

        Gate::define('marketing', function($user){
            return $user->peran->nama == 'marketing';
        });
    }
}
