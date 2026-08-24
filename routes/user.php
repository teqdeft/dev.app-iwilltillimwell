<?php 

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\CustomerManagementController;

use App\Http\Controllers\User\UserDashboardController;

use App\Http\Controllers\User\LabReportController;
use App\Http\Controllers\GeneralInformationController;




Route::group(['middleware' => ['auth','UserDashboardPaymentStatus']], function ($router) {



        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

		Route::get('/get-next-affirmation', [UserDashboardController::class, 'getNextAffirmation'])->name('get.next.affirmation');

        Route::get('/v1/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

		Route::get('/lab-report', [LabReportController::class, 'labsReportList'])->name('labsReportList');

		Route::get('/lab-report-download', [LabReportController::class, 'labsReportDownload'])->name('labsReportDownload');

		Route::get('/prescriptions', [UserDashboardController::class, 'prescriptions'])->name('prescriptions');

		Route::get('/semaglutide', [UserDashboardController::class, 'semaglutide'])->name('semaglutide');

		

		Route::get('/prescriptions-a-type', [UserDashboardController::class, 'prescriptions'])->name('prescriptions-a-type');

		Route::get('/prescriptions-b-type', [UserDashboardController::class, 'prescriptions'])->name('prescriptions-b-type');

		Route::get('/prescriptions-c-type', [UserDashboardController::class, 'prescriptions'])->name('prescriptions-c-type');

		

		

		Route::post('/prescriptions-payment', [UserDashboardController::class, 'prescriptionsPayment'])->name('prescriptions-payment');

		Route::post('/profile-img-deleted', [UserDashboardController::class, 'profileImgDeleted'])->name('profile-img-deleted');

		Route::post('/update-acknowledge', [UserDashboardController::class, 'updateAcknowledge'])->name('update-acknowledge');

		Route::get('/search-medication-dashboard',[UserDashboardController::class,'searchMedicationDashboard'])->name('pmedication.search.dashboard');

			

});

Route::get('/general-information/{type}',[GeneralInformationController::class, 'index']);
Route::post('/general-information/{type}',[GeneralInformationController::class, 'index']);



