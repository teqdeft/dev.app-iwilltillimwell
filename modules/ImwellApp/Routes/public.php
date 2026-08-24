<?php

use Illuminate\Support\Facades\Route;
use Modules\ImwellApp\Controllers\OrgAppController;
use Modules\ImwellApp\Controllers\OrgAuthController;

/*
| Organisation-branded member area:  /org/{slug}
|
| {slug} is the slugified ORGANISATION NAME (e.g. "Springfield High School"
| -> /org/springfield-high-school).
|
| The /org prefix is new - it does not collide with the existing
| /services/{slug} corporate route, so no existing route changes.
|
| Order matters: the fixed segments below are declared BEFORE the
| /{page} catch-all so they are never swallowed by it.
*/
Route::prefix('org/{slug}')->name('imwell.org.')->group(function () {

    // --- Guest: branded login + activation -------------------------------
    Route::get('/', [OrgAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [OrgAuthController::class, 'login'])->name('login.post');

    Route::get('/activate/{token}', [OrgAuthController::class, 'showActivate'])->name('activate');
    Route::post('/activate/{token}', [OrgAuthController::class, 'activate'])->name('activate.post');

    Route::post('/logout', [OrgAuthController::class, 'logout'])->name('logout');

    // --- Member area ------------------------------------------------------
    Route::middleware(['auth', 'imwell_org_member'])->group(function () {
        Route::get('/home', [OrgAppController::class, 'dashboard'])->name('home');

        // Feature pages. The gate resolves {page} -> feature key and 404s
        // (or redirects) when the admin has not enabled it for this org.
        Route::get('/{page}', [OrgAppController::class, 'page'])
            ->middleware('imwell_org_feature')
            ->name('page');
    });
});
