<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

       'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // Optional for mobile, but required if using cookies
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
       ],


    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'verify_user_payment' => \App\Http\Middleware\VerifyUserByPayment::class,
        'app_user' => \App\Http\Middleware\AppUser::class,
        'xss_protection' => \App\Http\Middleware\XSSProtection::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'web_user' => \App\Http\Middleware\WebUser::class,
        'affiliate' => \App\Http\Middleware\Affiliate::class,
        'counsellor' => \App\Http\Middleware\Counsellor::class,
        'adminManagers' => \App\Http\Middleware\AdminManagers::class,
        'user_mood' => \App\Http\Middleware\UserMoodWare::class,
        'MedicalProcess' => \App\Http\Middleware\checkMedicalProcess::class,
        'CompleteProfileCheck' => \App\Http\Middleware\completeProfileCheck::class,
        'HealthRecord' => \App\Http\Middleware\HealthRecordMiddleware::class,
        'AWMIpricing' => \App\Http\Middleware\checkAWMIpricing::class,
        'MobileViewVerifySteps' => \App\Http\Middleware\MobileViewVerifySteps::class,
        'TrackUtmSession' => \App\Http\Middleware\TrackUtmSession::class,
        'UserDashboardPaymentStatus' => \App\Http\Middleware\UserDashboardPaymentStatus::class
    ];
}
