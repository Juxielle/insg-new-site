<?php

namespace App\Providers;

use App\Models\Partenaire;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::defaultView('vendor.pagination.lyon3');
        Paginator::defaultSimpleView('vendor.pagination.lyon3');

        // Share partners with the footer
        View::composer('partials.footer', function ($view) {
            $view->with('footerPartenaires', Partenaire::ordered()->get());
        });
    }
}
