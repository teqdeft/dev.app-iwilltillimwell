<?php
namespace Modules\Pages;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{

    protected $controllersNamespace = "Modules\Pages\Controllers";

    public function boot(){
        parent::boot();
    }

    public function map(){
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(){
        Route::middleware(['web','auth', 'web_user'])
            ->namespace($this->controllersNamespace)
            ->as('pages')->prefix('pages')
            ->group(__DIR__."/Routes/user.php");

    }

}
