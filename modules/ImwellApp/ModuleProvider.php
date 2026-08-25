<?php

namespace Modules\ImwellApp;

use Modules\ModuleServiceProvider;

/**
 * Auto-discovered by Modules\ServiceProvider (registered in config/app.php).
 * No edits to routes/web.php, composer.json or config are required.
 */
class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/features.php', 'imwellapp');

        // org_can() / org_logo() for the shared sidebar. Loaded here so
        // composer.json autoload does not need changing.
        require_once __DIR__ . '/Support/helpers.php';

        $this->app->register(RouterServiceProvider::class);
    }
}
