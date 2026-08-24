<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerManagementController;
use App\Http\Controllers\Admin\TransactionHistoryController;
use App\Http\Controllers\Admin\PayoutController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'xss_protection', 'admin'])->group(function () {

    Route::get('/customers', [CustomerManagementController::class, 'index'])->name('customers.index');    
    Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('customers.index');    
	Route::get('/group-organization', [CustomerManagementController::class, 'groupOrganization'])->name('group-organization');
	Route::get('/group-organization-reward', [CustomerManagementController::class,'groupOrganizationReward'])->name('group-organization-reward');
	Route::get('/group-organization-commission-history', [CustomerManagementController::class,'groupOrganizationCommissionHistory'])->name('group-organization-commission-history');
	
	
	
	Route::post('/group-organization-reward-store', [CustomerManagementController::class,'groupOrganizationRewardStore'])->name('group-organization-reward-store');
	Route::post('/grouporganization-reward-store-list', [CustomerManagementController::class,'groupOrganizationRewardStoreList'])->name('group-organization-reward-store');
	Route::delete('group-organization-reward-delete/{id}', [CustomerManagementController::class, 'destroy'])->name('grouporganization-reward-destroy');
	

	
	Route::get('/payout/list', [PayoutController::class, 'index'])->name('payout-list-admin-section');
	Route::post('/payout/update', [PayoutController::class, 'payoutUpdateStatus'])->name('payout-update-status');
	
	
    Route::any('/customers-search', [CustomerManagementController::class, 'index'])->name('customers-search');
    Route::post('/customers-enroll-disernrolled', [CustomerManagementController::class, 'customersEnrollDisernrolledList'])->name('customers-enroll-disernrolled');
    Route::post('/customers-enroll-disernrolled-api', [CustomerManagementController::class, 'customersEnrollDisernrolledListAPI'])->name('customers-enroll-disernrolled-api');
	Route::post('/group-organization-save', [CustomerManagementController::class,'groupOrganizationSave'])->name('group-organization-save');
	Route::post('/group-organization-login-html', [CustomerManagementController::class,'grouporganizationloginhtml'])->name('group-organization-login-html');
	Route::post('/group-organization-login-save', [CustomerManagementController::class,'groupOrganizationLoginSave'])->name('group-organization-login-save');
    
});