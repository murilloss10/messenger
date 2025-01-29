<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\LogoutResponse;

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
        $this->app->environment('production') && URL::forceScheme('https');

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });

        // Facades\View::composer(['*'], function (View $view) {
        //     $userAuth   = Auth::check() ? Auth::user() : null;
                    
        //     $view->with([
        //         'userAuth'  => $userAuth,
        //     ]);
        // });
    }
}
