<?php

namespace App\Providers;

use App\Http\Composer\TenantDashboardComposer;
use App\Http\Composer\TenantMainMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        View::composer('layout.tenant', TenantMainMenuComposer::class);
        View::composer('tenant.main_menu', TenantDashboardComposer::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
