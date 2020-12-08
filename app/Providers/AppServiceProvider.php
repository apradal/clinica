<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Cookie\CookieJar;

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
    public function boot(CookieJar $cookieJar, Request $request)
    {
        if (!$request->hasCookie('is_christmas')) {
            view()->share('is_christmas', true);
            $cookieJar->queue(cookie('is_christmas', 1, 45000, null, null, false, false));
        } else {
            $cookie = $request->cookie('is_christmas');
            if ($cookie) {
                view()->share('is_christmas', true);
            } else {
                view()->share('is_christmas', false);
            }
        }
    }
}
