<?php

use Illuminate\Support\Facades\Route;
use Modules\ImwellApp\Controllers\OrgAuthController;

/*
| Organisation-branded entry point:  /org/{slug}
|
| {slug} is the slugified ORGANISATION NAME (e.g. "Springfield High School"
| -> /org/springfield-high-school).
|
| These routes only handle sign in and activation. Once authenticated the
| member is sent into the REAL application (/dashboard and the normal pages);
| what they may open there is enforced by EnforceOrgAccess, which the module's
| RouterServiceProvider pushes onto the "web" middleware group.
|
| The /org prefix is new - it does not collide with the existing
| /services/{slug} corporate route, so no existing route changes.
*/
Route::prefix('org/{slug}')->name('imwell.org.')->group(function () {

    Route::get('/', [OrgAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [OrgAuthController::class, 'login'])->name('login.post');

    Route::get('/activate/{token}', [OrgAuthController::class, 'showActivate'])->name('activate');
    Route::post('/activate/{token}', [OrgAuthController::class, 'activate'])->name('activate.post');

    Route::post('/logout', [OrgAuthController::class, 'logout'])->name('logout');
});
