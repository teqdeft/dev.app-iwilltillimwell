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

        $this->app->register(RouterServiceProvider::class);
    }
}
