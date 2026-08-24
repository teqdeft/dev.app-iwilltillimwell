<?php

namespace Modules\ImwellApp;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMiddlewareAliases();

        parent::boot();
    }

    public function map()
    {
        Route::middleware('web')->group(__DIR__ . '/Routes/admin.php');
        Route::middleware('web')->group(__DIR__ . '/Routes/public.php');
    }

    /**
     * Aliases are registered from inside the module so App\Http\Kernel stays
     * untouched.
     */
    protected function registerMiddlewareAliases()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('imwell_org_member', Middleware\EnsureOrgMember::class);
        $router->aliasMiddleware('imwell_org_feature', Middleware\EnsureOrgFeature::class);
    }
}
