<?php

namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

   		// Define a rate limiter for web routes (for example, 60 requests per minute)
    		RateLimiter::for('web', function (Request $request) {
        		return Limit::perMinute(60)->by($request->ip());
        	});
    }
}
