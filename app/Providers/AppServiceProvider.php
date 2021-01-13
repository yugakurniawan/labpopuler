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
            return $user->peran->nama == 'Pengurus Lab';
        });

        Gate::define('dokter-lab', function($user){
            if ($user->peran->nama == 'Pengurus Lab' || $user->peran->nama == 'Dokter') {
                return true;
            }
        });

        Gate::define('dokter-marketing', function($user){
            if ($user->peran->nama == 'Marketing' || $user->peran->nama == 'Dokter') {
                return true;
            }
        });

        Gate::define('marketing', function($user){
            return $user->peran->nama == 'Marketing';
        });

        Gate::define('manager_marketing', function($user){
            return $user->peran->nama == 'Manager Marketing';
        });

        Gate::define('dokter-manager_marketing', function($user){
            if ($user->peran->nama == 'Dokter' || $user->peran->nama == 'Manager Marketing') {
                return true;
            }
        });

        Gate::define('marketing-manager_marketing', function($user){
            if ($user->peran->nama == 'Marketing' || $user->peran->nama == 'Manager Marketing') {
                return true;
            }
        });

        Gate::define('dokter-marketing-manager_marketing', function($user){
            if ($user->peran->nama == 'Marketing' || $user->peran->nama == 'Dokter' || $user->peran->nama == 'Manager Marketing') {
                return true;
            }
        });
    }
}
