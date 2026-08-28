<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SafetyController;

use App\Http\Controllers\UserMoodController;

use App\Http\Controllers\Admin\ServicesController;

use App\Http\Controllers\JournalController as UserJournalController;

use App\Http\Controllers\Admin\JournalController as AdminJournalController;



Route::group(['middleware' => ['auth', 'xss_protection', 'admin']], function ($router) {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        /*  journal  */



        Route::group(['prefix' => 'journal'],function(){

            Route::get('/', [AdminJournalController::class, 'index'])->name('admin.journal')->middleware(['adminManagers:journal_add']);

            Route::get('/create', [AdminJournalController::class, 'create'])->name('admin.journal.create')->middleware(['adminManagers:journal_add']);

            Route::get('/{id}', [AdminJournalController::class, 'edit'])->middleware(['adminManagers:journals_edit']);

            Route::delete('/delete/{id}', [AdminJournalController::class, 'destroy'])->name('admin.journal.delete')

                        ->middleware(['adminManagers:journal_delete']);

            Route::post('/store', [AdminJournalController::class, 'store'])->name('admin.journal.store')

                        ->middleware(['adminManagers:journal_add']);

        });



        /*  services  */

        Route::group(['prefix' => 'corporate'],function(){

            Route::get('/', [ServicesController::class, 'index'])->name('admin.corporate')->middleware('adminManagers:services_view');

            Route::get('/create', [ServicesController::class, 'create'])->name('admin.corporate.create')->middleware('adminManagers:services_add');

            Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('admin.corporate.edit')->middleware('adminManagers:services_edit');



            Route::post('/store', [ServicesController::class, 'store'])->name('admin.corporate.store')->middleware('adminManagers:services_add');



            Route::post('/deleteImages', [ServicesController::class, 'deleteImages'])->name('admin.corporate.deleteImages')->middleware('adminManagers:services_add');



            Route::post('/block/{user}/{status}', [ServicesController::class, 'status_managment'])->name('admin.corporate.block')->middleware(['adminManagers:services_delete']);

        });



        Route::group(['prefix' => 'safety'],function(){  

            Route::get('/',[SafetyController::class,'index'])->name('admin.safety')->middleware(['adminManagers:safety_view']);

             Route::get('create',[SafetyController::class,'create'])->name('admin.safety.create')->middleware(['adminManagers:safety_add']);

             Route::post('store',[SafetyController::class,'store'])->name('admin.safety.store')->middleware(['adminManagers:safety_add']);

             Route::delete('delete/{id}', [SafetyController::class, 'destroy'])->name('admin.safety.delete')->middleware(['adminManagers:safety_delete']);

             Route::get('edit/{id}', [SafetyController::class, 'edit'])->middleware(['adminManagers:safety_edit']);

        });

    /*  admin route  */

    });

});



Route::group(['middleware' => ['auth', 'web_user']], function ($router) {

    Route::post('medical-form-by-user',[UserMoodController::class,'medicalFormByUser' ]);

});



