<?php

namespace App\Providers;

use App\Filters\PriceFilter;
use App\View\Composers\NavigationComposer;
use Domain\Catalog\Filters\FilterManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FilterManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app(FilterManager::class)->registerFilters([
           new PriceFilter()
        ]);
    }
}
