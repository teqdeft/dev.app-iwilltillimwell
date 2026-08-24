<?php 
namespace Modules\SharingPreference;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){
        
    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
}