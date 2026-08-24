<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupOrganizations\DashboardController;
use App\Http\Controllers\GroupOrganizations\CouponController;
use App\Http\Controllers\GroupOrganizations\MemberController;
use App\Http\Controllers\GroupOrganizations\CalculationController;
use App\Http\Controllers\GroupOrganizations\HistoryController;
use App\Http\Controllers\GroupOrganizations\WithdrawalController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['auth']], function ($router) {

        Route::get('/group-organizations', [DashboardController::class, 'index'])->name('group-organizations');
        Route::get('/group-organizations/my-account', [DashboardController::class, 'myAccount'])->name('group-organizations-my-account');
        Route::get('/group-organizations/my-current-plan', [DashboardController::class, 'myCurrentPlan'])->name('my-current-plan');
        Route::get('/group-organizations/coupon-list', [CouponController::class, 'index'])->name('coupon-list');
        Route::get('/group-organizations/ref-member-list', [MemberController::class, 'index'])->name('ref-member-list');
        Route::get('/group-organizations/calculation', [CalculationController::class, 'index'])->name('group-organizations-calculation');
        Route::get('/group-organizations/history', [HistoryController::class, 'index'])->name('group-organizations-history');
        Route::get('/group-organizations/order-history', [HistoryController::class, 'OrderHistory'])->name('group-order-history');
        Route::get('/group-organizations/withdrawal-list', [WithdrawalController::class, 'index'])->name('group-organizations-withdrawal-list');
        Route::get('/group-organizations/withdrawal-add', [WithdrawalController::class, 'addwithdrawalForm'])->name('group-organizations-withdrawal-add');
		
		
		Route::post('/group-organizations-update-profile', [DashboardController::class, 'updateProfile'])->name('group-organizations-update-profile');
		Route::post('/group-organizations/withdrawal-submit', [WithdrawalController::class, 'store'])->name('withdrawal.store');
			
});