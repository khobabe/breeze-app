<?php

namespace App\Providers;

use App\Policies\SupportTicketPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('view-ticket',[SupportTicketPolicy::class,'view']);
        Gate::define('close-ticket', [SupportTicketPolicy::class, 'close']); // Define close-ticket gate

    }
}
