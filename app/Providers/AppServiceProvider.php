<?php

namespace App\Providers;

use App\Models\BarangMasukBesiTua;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Observers\BarangMasukBesiTuaObserver;

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
        Paginator::useBootstrap();
        BarangMasukBesiTua::observe(BarangMasukBesiTuaObserver::class);
    }
}
