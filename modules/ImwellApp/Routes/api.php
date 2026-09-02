<?php

use Illuminate\Support\Facades\Route;
use Modules\ImwellApp\Controllers\Api\ShowcaseApiController;

/*
| The API the imwell.app site runs on.
|
| imwell.app has no database credentials and no Laravel - it reads organization
| and service content from here, and activates accounts through here, so every
| rule about what activation means stays in this application.
|
| RATE LIMITS. The app-wide "throttle:api" limiter counts 60 requests a minute
| per IP, and every request here arrives from one IP: the imwell.app server. A
| single organization's members opening their activation emails together would
| exhaust that between them and start seeing failures. So it is dropped for
| these routes and replaced with limits sized for one server rather than one
| person. What actually keeps these endpoints shut is VerifyShowcaseKey - the
| shared secret, which fails closed when unset.
*/
Route::prefix('api/imwell')
    ->name('imwell.api.')
    ->middleware(['imwell_showcase_key'])
    ->withoutMiddleware(['throttle:api'])
    ->group(function () {

        // Landing content for an organization page. Read-only and public-ish,
        // so the loosest limit: this is hit on every page view.
        Route::get('/org/{slug}', [ShowcaseApiController::class, 'org'])
            ->name('org')
            ->middleware('throttle:600,1');

        // Reading an activation link. One member does this once or twice.
        Route::get('/org/{slug}/activation/{token}', [ShowcaseApiController::class, 'activationShow'])
            ->name('activation.show')
            ->middleware('throttle:300,1');

        // Spending one. Tighter, because it writes - but still well above what
        // a real activation window needs.
        Route::post('/org/{slug}/activation/{token}', [ShowcaseApiController::class, 'activate'])
            ->name('activation.submit')
            ->middleware('throttle:120,1');
    });
