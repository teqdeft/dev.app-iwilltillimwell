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

        // Called by the imwell.app site, never by a browser on this domain -
        // stateless, so the "api" group rather than "web".
        Route::middleware('api')->group(__DIR__ . '/Routes/api.php');
    }

    /**
     * Aliases are registered from inside the module so App\Http\Kernel stays
     * untouched.
     */
    protected function registerMiddlewareAliases()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('imwell_org_member', Middleware\EnsureOrgMember::class);

        // Shared-secret gate for /api/imwell/*, the endpoints imwell.app calls.
        $router->aliasMiddleware('imwell_showcase_key', Middleware\VerifyShowcaseKey::class);

        // Applies to the whole real application, but is a no-op for anyone who
        // is not an ImWell org member - see EnforceOrgAccess.
        $router->pushMiddlewareToGroup('web', Middleware\EnforceOrgAccess::class);
    }
}
