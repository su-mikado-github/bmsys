<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('use', function($expression) {
            return "<?php use {$expression}; ?>";
        });
        Blade::directive('eval', function($expression) {
            return "<?php {$expression}; ?>";
        });
        Blade::directive('debug', function($expression) {
            return "<?php logger()->debug({$expression}); ?>";
        });

    }
}
