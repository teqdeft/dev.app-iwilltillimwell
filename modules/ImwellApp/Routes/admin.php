<?php

use Illuminate\Support\Facades\Route;
use Modules\ImwellApp\Controllers\Admin\OrgImportController;
use Modules\ImwellApp\Controllers\Admin\OrgSetupController;

/*
| Admin - ImWell App Setup
| Reuses the app's existing admin gate (auth + xss_protection + admin) so
| permissions behave exactly like every other admin screen.
*/
Route::prefix('admin/imwell-app')
    ->name('imwell.admin.')
    ->middleware(['auth', 'xss_protection', 'admin'])
    ->group(function () {

        Route::get('/', [OrgSetupController::class, 'index'])->name('index');
        Route::get('/create', [OrgSetupController::class, 'create'])->name('create');
        Route::post('/store', [OrgSetupController::class, 'store'])->name('store');
        Route::get('/edit/{org}', [OrgSetupController::class, 'edit'])->name('edit');
        Route::post('/update/{org}', [OrgSetupController::class, 'update'])->name('update');
        Route::post('/status/{org}', [OrgSetupController::class, 'toggleStatus'])->name('status');
        Route::delete('/delete/{org}', [OrgSetupController::class, 'destroy'])->name('delete');
        Route::post('/slug-preview', [OrgSetupController::class, 'slugPreview'])->name('slug-preview');

        // Import users into a specific organisation (org comes from context).
        Route::get('/{org}/import', [OrgImportController::class, 'form'])->name('import.form');
        Route::post('/{org}/import', [OrgImportController::class, 'import'])->name('import.run');
        Route::get('/{org}/members', [OrgImportController::class, 'members'])->name('import.members');
        Route::get('/sample-csv', [OrgImportController::class, 'sampleCsv'])->name('import.sample');
        Route::post('/{org}/resend/{user}', [OrgImportController::class, 'resendActivation'])->name('import.resend');
    });
