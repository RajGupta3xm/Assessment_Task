<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Listeners\MarkUserOnline;
use App\Listeners\MarkUserOffline;

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
    
    
     Event::listen(Login::class, [MarkUserOnline::class, 'handle']);
    Event::listen(Logout::class, [MarkUserOffline::class, 'handle']);
}
}
