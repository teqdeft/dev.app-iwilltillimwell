<?php
namespace Modules\SharingPreference;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{

    protected $controllersNamespace = "Modules\SharingPreference\Controllers";

    public function boot(){
        parent::boot();
    }

    public function map(){
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(){
        Route::middleware('web')
            ->namespace($this->controllersNamespace)
            ->as('share')->prefix('share')
            ->group(__DIR__."/Routes/user.php");

    }

}
