<?php

namespace App\Providers;

use App\Models\BusinessDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
    View::composer('*', function ($view) {
        // Avoid querying if user is not authenticated
        if (Auth::check()) {
            $business = \App\Models\BusinessDetails::first();
            $view->with('business', $business);
        }
    });
    }
}
