<?php
namespace Modules\HealthRecord;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{

    protected $controllersNamespace = "Modules\HealthRecord\Controllers";

    public function boot(){
        parent::boot();
    }

    public function map(){
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(){
        Route::middleware('web')
            ->namespace($this->controllersNamespace)
            ->group(__DIR__."/Routes/user.php");

    }

}
