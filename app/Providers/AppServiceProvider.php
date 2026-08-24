<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Services\KurvPaymentService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton(KurvPaymentService::class, function () {
            return new KurvPaymentService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $environment = env('BTREE_ENVIRONMENT');
       $braintree = new \Braintree\Gateway([
            'environment' => $environment,
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);
        config(['braintree' => $braintree]);
        Paginator::useBootstrap();
    }
}
