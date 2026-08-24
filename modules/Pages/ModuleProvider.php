<?php
namespace Modules\Pages;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

}
