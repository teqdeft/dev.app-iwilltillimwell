<?php



use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Http;

use App\Http\Controllers\AppController;

use App\Http\Controllers\PetController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\PromoCodeController;

use App\Http\Controllers\ProvidersController;

use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\Admin\PlanController;

use App\Http\Controllers\CounselingController;

use App\Http\Controllers\Admin\GroupCounseling;

use App\Http\Controllers\Admin\RolesController;

use App\Http\Controllers\MedicalcareController;

use App\Http\Controllers\ConsultationController;

use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\Admin\PlanTypeController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\CategoriesController;

use App\Http\Controllers\Admin\ManagePageController;

use App\Http\Controllers\Admin\PermissionController;

use App\Http\Controllers\Admin\AffirmationController;

use App\Http\Controllers\Admin\JournalController;

use App\Http\Controllers\Admin\ServicesController;

use App\Http\Controllers\MessageSpecialistController;



use App\Http\Controllers\Counsellor\SessionController;

use App\Http\Controllers\Auth\LoginController as LoginController;

use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\Affiliate\UserController as AffiliateUserController;

use App\Http\Controllers\Affiliate\DashboardController as AffiliateDashboardController;

use App\Http\Controllers\Counsellor\DashboardController as CounsellorDashboardController;

use App\Http\Controllers\Affiliate\TransactionController as AffiliateTransactionController;

use App\Http\Controllers\CBTController;

use App\Http\Controllers\GraphController;

use App\Http\Controllers\GeneralInformationController;

use App\Http\Controllers\SafetyController;

use App\Http\Controllers\UserMoodController;

use App\Http\Controllers\VJController;

require base_path('routes/admin.php');

require base_path('routes/group-organizations.php');

require base_path('routes/user.php');

require base_path('routes/lyricapi.php');


require base_path('routes/payment.php');

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



// Route::get('/', function () {

//     return view('welcome');

// });



Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');

Route::post('/custom-login', [LoginController::class, 'customLogin'])->name('custom-login');







Auth::routes();



Route::get('/clear-cache', function() {

   $exitCode = Artisan::call('config:clear');

   Artisan::call('cache:clear');

   Artisan::call('view:clear');

   return $exitCode;

   // return what you want

});





// APP User Login //

Route::get('app-redirect/{key}', [UserController::class, 'appUSer']);



Route::get('/check-subscription', [SubscriptionController::class, 'handleBraintreeSubscription'])->name('braintree.subscription');



Route::post('/user-register', [UserController::class, 'store'])->name('customRegister');



Route::get('/awmi-register', [UserController::class, 'showRegistrationForm'])->name('awmiRegister');

Route::post('/awmi-store', [UserController::class, 'storeAwmi'])->name('storeAwmi');

Route::get('/awmi-pricing', [AppController::class, 'awmi_pricing'])->name('awmiPricing');



Route::get('/memberPlan', [AppController::class, 'memberPlan'])->name('memberPlan');



Route::post('/checkEmailExist', [UserController::class, 'checkEmailExist']);



Route::post('/update-step', [UserController::class, 'updateStep'])->name('updateStep');



Route::get('/medical-care-consent', [HomeController::class, 'medicalCareConsent'])->name('medicalCareConsent');

Route::get('/counseling', [HomeController::class, 'counseling'])->name('counseling');

Route::get('/healthcare-advocacy', [HomeController::class, 'healthcareAdvocacy'])->name('healthcareAdvocacy');

Route::get('/message-specialist', [HomeController::class, 'messageSpecialist'])->name('messageSpecialist');



//  app pages

Route::get('/access-lgbtq', [AppController::class, 'accessLgbtq']);

Route::get('/access-latino', [AppController::class, 'accessLatino']);

Route::get('/access-bipoc', [AppController::class, 'accessBipoc']);

Route::get('/about', [AppController::class, 'about']);

Route::get('/security-platform', [AppController::class, 'securityPlatform']);

Route::get('/medical-faqs', [AppController::class, 'medicalFaqs']);

Route::get('/counseling-faqs', [AppController::class, 'counselingFaqs']);

Route::get('/prescription-faqs', [AppController::class, 'prescriptionFaqs']);

Route::get('/legal-service', [AppController::class, 'legalService']);

Route::get('/working-anxiety', [AppController::class, 'workingAnxiety']);

Route::get('/hgealthy-boundaries', [AppController::class, 'hgealthyBoundaries']);

Route::get('/grief-loss', [AppController::class, 'griefLoss']);

Route::get('/emotion-regulation', [AppController::class, 'emotionRegulation']);

Route::get('/understanding-purpose', [AppController::class, 'understandingPurpose']);

Route::get('/legal-informational', [AppController::class, 'legalInformational']);

Route::get('/groupcounseling-faq', [AppController::class, 'groupcounselingFaq']);

Route::get('/groupcounseling-faq', [AppController::class, 'groupcounselingFaq']);

Route::get('/enterprise-erp', [AppController::class, 'enterpriseErp']);

Route::get('/pet-telehealth', [AppController::class, 'petTelehealth']);

Route::get('/podcasts-blogs', [AppController::class, 'podcastsBlogs']);

Route::get('/knowledge-library', [AppController::class, 'knowledgeLibrary']);

Route::get('/brochure', [AppController::class, 'brochure']);

Route::get('/brochures/{slug}', [AppController::class, 'brochureItem']);

Route::get('/blogs/{category_id?}', [AppController::class, 'blogs']);

Route::get('/blog-details/{slug}', [AppController::class, 'blogDetails']);

// policies

Route::get('/agreement', [AppController::class, 'agreement']);

Route::get('/privacy-policy', [AppController::class, 'privacyPolicy']);

Route::get('/term-and-conditions', [AppController::class, 'termAndCondiction']);

// Only for mobile View Router [ According to design ]

Route::get('/support-and-faqs', [AppController::class, 'supportFaqs'])->name('support-and-faqs');



Route::get('/disclaimer', [AppController::class, 'disclaimer']);

Route::get('/cookie-policy', [AppController::class, 'cookiePolicy']);

Route::get('/refund-policy', [AppController::class, 'refundPolicy']);

Route::get('/pet-faq', [AppController::class, 'petFaq'])->name('pet-faq');



Route::get('/topics/{slug}', [AppController::class, 'showRssFeeds']);





Route::get('/services/{slug}', [AppController::class, 'services'])->middleware(['auth']);

Route::get('/anxiety/{slug}/give-consent', [AppController::class, 'anexity'])->middleware(['auth']);

Route::get('/depression/{slug}/give-consent', [AppController::class, 'depression'])->middleware(['auth']);

Route::get('/abuse/{slug}/give-consent', [AppController::class, 'abuse'])->middleware(['auth']);



Route::post('/save-visitor', [AppController::class, 'saveVisitor']);

Route::post('/save-quiz-result ', [AppController::class, 'saveQuizResult']);



Route::get('/pricing', [AppController::class, 'pricing']);

Route::get('/contact-us', [AppController::class, 'contactUs']);

Route::post('/contact-us', [AppController::class, 'contactusPost']);





/* Route::get('/inspirational', [AppController::class, 'inspirational']);

Route::get('/healthy-food', [AppController::class, 'healthy_food']); */

// providers

Route::get('/providers', [ProvidersController::class, 'providers']);

Route::get('/mental-health-professionals', [ProvidersController::class, 'mentalHealthProfessionals']);

Route::get('/organizations', [ProvidersController::class, 'organizations']);

Route::get('/professional-welllness-partners', [ProvidersController::class, 'professionalWelllnessPartners']);



// counseling

Route::get('/host-group-counseling/{token?}', [CounselingController::class, 'hostGroupCounseling']);

Route::get('/counseling', [CounselingController::class, 'counseling']);

Route::get('/tele-counseling', [CounselingController::class, 'teleCounseling']);

Route::get('/group-counseling', [CounselingController::class, 'groupCounseling']);

Route::post('/setTimeZone', [CounselingController::class, 'setTimeZone']);



Route::get('/get-all-counseling', [CounselingController::class, 'getAllCounseling']);





Route::post('/subscribe-to-counseling', [CounselingController::class, 'subscribeToCounseling'])->name('subscribe-to-counseling');

Route::get('/counseling-remainder-mail', [CounselingController::class, 'counselingRemainderMail']);



Route::get('/counseling-refund-payment', [CounselingController::class, 'counselingRefundPayment']);



Route::get('/find/{id}', [CounselingController::class, 'find']);



// Medicalcare

Route::get('/telemedicine', [MedicalcareController::class, 'telemedicine']);

Route::get('/advocay-program', [MedicalcareController::class, 'advocayProgram']);

Route::get('/prescription-policy', [MedicalcareController::class, 'prescriptionPolicy']);





// Get Api data

Route::get('/import-states', [ConsultationController::class, 'importStates']);

Route::get('/import-timezone', [ConsultationController::class, 'importTimezones']);



Route::post('/store-general-info', [ConsultationController::class, 'storeGeneralInfo'])->name('store.generalinfo');

Route::post('/store-dependent-info', [ConsultationController::class, 'storeDependentInfo'])->name('store.dependentinfo');



Route::post('/store-consultation', [ConsultationController::class, 'storeConsultation'])->name('store.consultation');

Route::get('/logout', [LoginController::class, 'logout'])->name("logout");



Route::get('services-login',[AppController::class, 'login'])->name('services-login');



Route::get('/feels/logout', [AppController::class, 'logout'])->name('feels/logout');



/* affirmation cron job   */



Route::get('/sendAffirmationToUsers', [AppController::class, 'sendAffirmationToUsers']);









Route::group(['middleware' => ['auth', 'web_user']], function ($router) {





         

            //Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');



			Route::post('/apply-promo-code', [SubscriptionController::class, 'applyPromoCode'])->name('apply-promo-code');

			Route::post('/braintree-payment', [SubscriptionController::class, 'handleBraintreePayments'])->name('braintree.payment');

			

			Route::get('/free-trail-payment-subscription', [SubscriptionController::class, 'freeTrailSubscription'])->name('freeTrailSubscription');

			

			

			Route::post('/braintree-payment-awmi-family', [SubscriptionController::class, 'handleBraintreePaymentsAwmiFamily'])->name('braintree.payment-awmi');

			Route::post('/account-active-coupon-code', [SubscriptionController::class, 'accountActiveCouponCode'])->name('account-active-coupon-code');



			Route::group(['middleware' => ['verify_user_payment','CompleteProfileCheck','MedicalProcess']], function ($router) {



			//  Stripe payment

			Route::post('/stripe-payment', [SubscriptionController::class, 'handlePost'])->name('stripe.payment');



			Route::get('/information-intake', [ConsultationController::class, 'informationIntake']);

			Route::get('/create-plan', [SubscriptionController::class, 'createPlan']);

			Route::get('/create-discount', [SubscriptionController::class, 'createDiscount']);

			Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe');

			Route::post('/cancel-subscription', [UserController::class, 'cancelSubscription'])->name('cancel-subscription');



            /*  health record  start */



 /*            Route::get('/personal-record/{user?}', [HomeController::class, 'personalRecord']);

            Route::get('/medication-allergy-inactive/{allergyId}/{user}', [ConsultationController::class, 'medicationAllergyInactive'])->where('allergyId', '[0-9]+');

			Route::get('/load-personal-popup/{user}', [HomeController::class, 'personalPopup'])->where('user', '[0-9]+');

			Route::post('/store-medication/{user}', [ConsultationController::class, 'storeMedication'])->name('store.medication');

			Route::get('/search-medication', [ConsultationController::class, 'searchMedication']);

			Route::get('/medications/{user?}', [HomeController::class, 'medications']);

			Route::get('/medication-inactive/{medication}/{user}', [ConsultationController::class, 'medicationInactive'])->where('medication', '[0-9]+');



			Route::get('/medication-allergies/{user?}', [HomeController::class, 'medicationAllergies']);



			Route::post('/medication-allergies/delete', [HomeController::class, 'medicationAllergiesDelete']);

			Route::get('/search-medication-allergy', [ConsultationController::class, 'searchMedicationAllergy']);



			Route::post('/store-medication-allergy/{user}', [ConsultationController::class, 'storeMedicationAllergy'])->name('store.medication.allergy');

			Route::post('/store-medical-condition/{user}', [ConsultationController::class, 'storeMedicalCondition'])->name('store.medicalcondition');

			Route::get('/medical-history/{user?}', [HomeController::class, 'medicalHistory']);

			Route::delete('/medical-history-inactive/{medicalConditionId}/{user}', [ConsultationController::class, 'medicalHistoryInactive'])->where('medicalConditionId', '[0-9]+');

			Route::get('/load-history-popup/{condition}', [HomeController::class, 'medicalHistoryPopup'])->where('condition', '[0-9]+');

			Route::post('/medical-history-update/{medicalConditionId}', [ConsultationController::class, 'medicalHistoryUpdate'])->name('update.medical.history');



			Route::get('/document-manager/{user?}', [HomeController::class, 'documentManager']);

			Route::delete('/delete-document/{document?}', [HomeController::class, 'deleteDocument'])->name('documents.destroy');

			Route::post('/update-personal-info/{user}', [ConsultationController::class, 'updatePersonalInfo'])->name('update.personal.info');

			Route::post('/upload-document/{user?}', [HomeController::class, 'uploadDocument'])->name('upload-document'); */



            /*  health record  start */











			Route::get('/schedule-consultation/{type?}/{step?}/{id?}', [ConsultationController::class, 'consultForm']);			

			Route::post('/schedule-consultation-upload-img', [ConsultationController::class, 'DermatologyUploadImg'])->name('DermatologyUploadImg');			

			Route::post('/get-doctors-list', [ConsultationController::class, 'getDoctorsList'])->name('getDoctorsList');

			Route::get('/consultation-type', [ConsultationController::class, 'consultationType'])->name('consultationType');

			

			Route::post('/create-consultation', [ConsultationController::class, 'createConsultation'])->name('create-consultation');

			Route::post('/update-consultation/{id}', [ConsultationController::class, 'updateConsultation'])->name('update.consultation');

			Route::post('/createConsultationPayment', [ConsultationController::class, 'createConsultationPayment'])->name('createConsultationPayment');

			Route::post('/createConsultationSubmit', [ConsultationController::class, 'createConsultationSubmit'])->name('createConsultationSubmit');

			Route::get('/braintree/token', [SubscriptionController::class, 'token']);

			Route::post('/braintree/pay', [SubscriptionController::class, 'process']);

			

			

			//Route::get('/my-account', [UserController::class, 'profile'])->name('my-account');

			Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-account');

			Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');

			Route::post('/add-dependent', [UserController::class, 'addDependent'])->name('add-dependent');

			Route::post('/update-dependent', [UserController::class, 'updateDependent'])->name('update-dependent');



			Route::get('/behavioral-health', [HomeController::class, 'behavioralHealth'])->name('behavioral-health');

			Route::get('/in-the-moment-care', [HomeController::class, 'inTheMomentCare'])->name('in-the-moment-care');

			Route::get('/care-coordination', [HomeController::class, 'careCoordination'])->name('carecoordination');

			Route::get('/my-consultations/print-out', [HomeController::class, 'printOut']);

			Route::get('/my-consultations/{status?}', [HomeController::class, 'myConsultations']);

			Route::post('/my-consultations-dashboard', [HomeController::class, 'myConsultationsDashboard'])->name('my-consultations-dashboard');



			Route::post('/resend-dependent-email/{user?}', [UserController::class, 'resendDependentRegisterEMail'])->name('resend.dependent.email');

			Route::post('/update-user-status/{user?}', [UserController::class, 'updateUserStatus'])->name('update.status');

			Route::post('/update-dependent-relation/{user?}', [UserController::class, 'updateDependentRelationship'])->name('update.relatioship');

			Route::post('/search-pharmacy', [UserController::class, 'searchPharmacy'])->name('search-pharmacy');

			Route::post('/update-pharmacy', [UserController::class, 'updatePharmacy'])->name('update-pharmacy');

			Route::delete('/cancel-consultatation/{consultation?}', [ConsultationController::class, 'cancelConsultation'])->name('consultations.cancel');

			

			/************ Pet  ***********/

			

			Route::get('/pets', [PetController::class, 'pets'])->name('pets.pets');

			Route::get('pets/edit/{id}', [PetController::class, 'edit'])->name('pets.edit');

			Route::get('pets/pet-name/{id}', [PetController::class, 'petName'])->name('pets.pet-name');

			Route::get('pets/getAllProblem', [PetController::class, 'getAllProblem'])->name('pets.getAllProblem');

			Route::post('/pets/store', [PetController::class, 'store'])->name('pets.store');

			

			

			

			

			



			Route::post('/pets/schedule', [PetController::class, 'schedule'])->name('pets.schedule');

			Route::post('/pets/schedule-cancel', [PetController::class, 'scheduleCancel'])->name('pets.schedule-cancel');

			Route::post('/pets/profile-upload', [PetController::class, 'profileUpload'])->name('pets.profile-upload');



			Route::get('/pet-consultations/{status?}', [PetController::class, 'petConsultations']);



			Route::get('/message-a-specialist', [MessageSpecialistController::class, 'index']);

			Route::get('/getMessageHeaders', [MessageSpecialistController::class, 'getMessageHeaders']);

			Route::get('/getSingleMessage', [MessageSpecialistController::class, 'getSingleMessage']);

			Route::post('/postMessage', [MessageSpecialistController::class, 'postMessage']);

			Route::get('/getMessageHeadersByView', [MessageSpecialistController::class, 'getMessageHeadersByView']);

			Route::post('/archiveMsg', [MessageSpecialistController::class, 'archiveMsg']);

			Route::post('/postMessageReply', [MessageSpecialistController::class, 'postMessageReply'])->name('postMessageReply');



		});

});





Route::group(['middleware' => ['auth', 'xss_protection', 'admin']], function ($router) {



	//Route::get('/logout', [LoginController::class, 'logout']);

	Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

		Route::get('/', function () {

			return redirect('/admin/dashboard');

		});

		Route::post('/accessPermissionUserData', [AdminUserController::class, 'accessPermissionUserData']);

		Route::post('/users/access-permission', [AdminUserController::class, 'storeAccessPermission']);



		Route::get('/dashboard/', [DashboardController::class, 'index'])->name('admin-dashboard');

		Route::get('/users/subscriber', [AdminUserController::class, 'list'])->name('admin.users.subscriber')->middleware(['adminManagers:users_view']);

		Route::get('/users/employee', [AdminUserController::class, 'list'])->name('admin.users.employee')->middleware(['adminManagers:users_view']);

		Route::get('/users/show/{user}', [AdminUserController::class, 'show'])->name('admin.users.view')->middleware(['adminManagers:users_view']);

		Route::get('/users/download/{type}', [AdminUserController::class, 'download'])->name('admin.users.download')->middleware(['adminManagers:users_view']);



		Route::get('/users/download-dummy/{type}', [AdminUserController::class, 'downloadDummy'])->name('admin.users.download-dummy')->middleware(['adminManagers:users_view']);



		Route::post('/users/import-subscriber', [AdminUserController::class, 'importSubscriber'])->name('admin.users.import-subscriber')->middleware(['adminManagers:users_view']);



		Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create')->middleware(['adminManagers:users_create']);



		Route::post('/users/store', [AdminUserController::class, 'store'])->name('admin.users.store')->middleware(['adminManagers:users_edit']);



		Route::get('/users/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit')->middleware(['adminManagers:users_edit']);

		Route::get('/users/update', [AdminUserController::class, 'update'])->name('admin.users.update')->middleware(['adminManagers:users_edit']);

		Route::post('/users/block/{user}/{status}', [AdminUserController::class, 'status_managment'])->name('admin.users.block')->middleware(['adminManagers:users_delete']);



		Route::delete('/users/delete/{user}', [AdminUserController::class, 'delete'])->name('admin.users.delete')->middleware(['adminManagers:users_delete']);



		Route::get('/promo-codes/create', [PromoCodeController::class, 'create'])->name('create')->middleware(['adminManagers:promo_codes_add']);

		Route::get('/promo-codes', [PromoCodeController::class, 'index'])->name('index')->middleware(['adminManagers:promo_codes_view']);

		Route::post('/promo-codes/store', [PromoCodeController::class, 'store'])->name('store')->middleware(['adminManagers:promocodes_add']);

		Route::delete('/promo-codes/delete/{id}', [PromoCodeController::class, 'delete'])->name('delete')->middleware(['adminManagers:promo_codes_delete']);

		Route::get('/promo-codes/{id}', [PromoCodeController::class, 'show'])->name('show')->middleware(['adminManagers:promo_codes_view']);

		Route::post('/promo-codes/payment/{id}/{status}/{amount}', [PromoCodeController::class, 'payment_status'])->name('admin.promo-codes.payment')->middleware(['adminManagers:promo_codes_edit']);

		Route::get('/promo-codes/edit/{id}', [PromoCodeController::class, 'edit'])->name('admin.promo-codes.edit')->middleware(['adminManagers:promo_codes_edit']);



		Route::get('/group-counseling', [GroupCounseling::class, 'createGroupCounseling'])->name('group-counseling')->middleware(['adminManagers:group-counseling_view']);

		Route::get('/get-all-counseling', [GroupCounseling::class, 'getAllCounseling'])->name('get-all-counseling')->middleware(['adminManagers:group-counseling_view']);

		Route::get('/group-counseling/add-edit-form', [GroupCounseling::class, 'loadAddEditModal'])->name('add-edit-form')->middleware(['adminManagers:group-counseling_add']);



		Route::get('/group-counseling/add-form', [GroupCounseling::class, 'loadAddtModal'])->name('add-form')

			->middleware(['adminManagers:group_counseling_add']);

		Route::get('/group-counseling/edit-form/{id}', [GroupCounseling::class, 'loadEditModal'])->name('edit-form')->middleware(['adminManagers:group_counseling_edit']);



		Route::get('/group-counseling/{id}', [GroupCounseling::class, 'viewGroupCounselingDetails'])->name('view-group-counseling-details')->middleware(['adminManagers:group-counseling_view']);

		Route::delete('/group-counseling/delete/{id}', [GroupCounseling::class, 'delete'])->name('delete-group-counseling')->middleware(['adminManagers:group-counseling_delete']);

		Route::post('/counseling/create', [GroupCounseling::class, 'createSesson'])->name('create-session')->middleware(['adminManagers:group-counseling_add']);



		/* mamange Content */



		Route::get('/manage-page', [ManagePageController::class, 'index'])->name('manage-page')->middleware(['adminManagers:manage_content_view']);

		// Route::get('/manage-page/landing', [ManagePageController::class, 'getlandingPage'])->name('manage-landing-page');

		Route::post('/manage-page/update-page', [ManagePageController::class, 'updatePage'])->name('manage-page-update')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/landing', [ManagePageController::class, 'getlandingPage'])->name('manage-landing-page')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/tele-counseling', [ManagePageController::class, 'getTeleCounseling'])->name('tele-counseling')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/group-counseling', [ManagePageController::class, 'updatePage'])->name('group-counseling')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/about-group-counseling', [ManagePageController::class, 'getAboutGroupCounseling'])->name('about-group-counseling')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/working-with-anexity', [ManagePageController::class, 'getWorkingWithAnexity'])->name('working-with-anexity')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/healthy-boundaries-relations', [ManagePageController::class, 'getHealthyBoundaries'])->name('healthy-boundaries-relations')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/grief-loss', [ManagePageController::class, 'getGriefLoss'])->name('grief-loss')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/emotion-regulations', [ManagePageController::class, 'getEmotionRegulations'])->name('emotion-regulations')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/understanding-purpose', [ManagePageController::class, 'getUnderstandingPurpose'])->name('understanding-purpose')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/telemedicine', [ManagePageController::class, 'getTelemedicine'])->name('telemedicine')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/message-a-specialist', [ManagePageController::class, 'getMessageSpecialist'])->name('message-a-specialist')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/advocacy-program', [ManagePageController::class, 'getAdvocacyProgram'])->name('advocacy-program')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/precription-program', [ManagePageController::class, 'getPrescriptionProgram'])->name('precription-program')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/professional-welllness-partners', [ManagePageController::class, 'getProfessionalWelnessPartners'])->name('professional-welllness-partners')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/legal-informational-services', [ManagePageController::class, 'getLegalInformationServices'])->name('legal-informational-services')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/medical-faq', [ManagePageController::class, 'getMedicalFaq'])->name('medical-faq')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/counseling-faq', [ManagePageController::class, 'getCounselingFaq'])->name('counseling-faq')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/prescription-faq', [ManagePageController::class, 'getPrescriptionFaq'])->name('prescription-faq')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/legal-information-services-faq', [ManagePageController::class, 'getLegalFaq'])->name('legal-information-services-faq')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/group-counseling-faq', [ManagePageController::class, 'getGroupCounseling'])->name('group-counseling-faq')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/pet-tele-health', [ManagePageController::class, 'getPetTeleHealth'])->name('pet-tele-health')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/enterprise-eap', [ManagePageController::class, 'getEnterpriseEAP'])->name('enterprise-eap')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/podcast-blogs', [ManagePageController::class, 'getPodCasts'])->name('podcast-blogs')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/knowledge-library', [ManagePageController::class, 'getKnowledgeLibrary'])->name('knowledge-library')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/about', [ManagePageController::class, 'getAbout'])->name('about')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/biopoc', [ManagePageController::class, 'getBiopic'])->name('biopoc')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/latino-lantinx', [ManagePageController::class, 'getLatinoLantix'])->name('latino-lantinx')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/lgbtq', [ManagePageController::class, 'getlgbtq'])->name('lgbtq')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/lgbtq', [ManagePageController::class, 'getlgbtq'])->name('lgbtq')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/pet-telehealth', [ManagePageController::class, 'getAllPetTeleHealth'])->name('pet-telehealth')->middleware(['adminManagers:manage_content_view']);

		Route::get('/manage-page/privacy', [ManagePageController::class, 'privacyPolicy'])->name('privacy-policy')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/term-and-conditions', [ManagePageController::class, 'termCondiction'])->name('term-and-conditions')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/pet-faq', [ManagePageController::class, 'getPetFaq'])->name('pet-faq')->middleware(['adminManagers:manage_content_view']);



		Route::get('/manage-page/brochure', [ManagePageController::class, 'brochure'])->name('brochure')->middleware(['adminManagers:manage_content_view']);







		Route::match(['get', 'post'], '/manage-page/rss-feeds', [ManagePageController::class, 'rssFeeds'])->middleware(['adminManagers:manage_content_view']);





		/* influencers */



		Route::get('/influencers', [AdminUserController::class, 'getInfluencers'])->name('admin.influencers.get')->middleware(['adminManagers:affiliates_counselors_view']);

		Route::get('/influencers/counsellor', [AdminUserController::class, 'getInfluencers'])->name('admin.counsellor.get')->middleware(['adminManagers:affiliates_counselors_view']);

		

		Route::get('/influencers/create', [AdminUserController::class, 'createInfluencer'])->name('admin.influencers.create')->middleware(['adminManagers:affiliates_counselors_add']);

		Route::post('/influencers', [AdminUserController::class, 'storeInfluencer'])->name('admin.influencers.store')->middleware(['adminManagers:affiliates_counselors_add']);

		Route::delete('/influencers/delete/{id?}', [AdminUserController::class, 'deleteInfluencer'])->middleware(['adminManagers:affiliates_counselors_delete']);

		Route::delete('/influencers/counsellor/delete/{id}', [AdminUserController::class, 'deleteCounseller'])->middleware(['adminManagers:affiliates_counselors_delete']);

		//Route::get('/influencers/{type}', [TransactionController::class, 'index']);

		Route::post('/influencers/payment/{id}/{status}', [PromoCodeController::class, 'payment_status'])->name('admin.promo-codes.payment')->middleware(['adminManagers:affiliates_counselors_add']);



		Route::get('/influencers/{id}', [AdminUserController::class, 'transactionHistory'])->middleware(['adminManagers:affiliates_counselors_view']);



		Route::get('/influencers/type/{id}', [AdminUserController::class, 'influencersWithType'])->middleware(['adminManagers:affiliates_counselors_view']);



		/* Plains */



		Route::get('/plans', [PlanController::class, 'index'])->name('admin.plans')->middleware(['adminManagers:plans_view']);

		Route::get('/plans/create', [PlanController::class, 'create'])->name('admin.plans.create')->middleware(['adminManagers:plans_add']);

		Route::post('/plans/store', [PlanController::class, 'store'])->name('admin.plans.store')->middleware(['adminManagers:plans_add']);

		Route::delete('/plans/delete/{id}', [PlanController::class, 'delete'])->name('admin.plans.delete')->middleware(['adminManagers:plans_delete']);

		Route::get('/plans/{id}', [PlanController::class, 'edit'])->name('admin.plans.edit')->middleware(['adminManagers:plans_edit']);

		Route::post('/plans/update', [PlanController::class, 'update'])->name('admin.plans.update')->middleware(['adminManagers:plans_edit']);



		/* Plain Type */

		Route::get('/plan-type', [PlanTypeController::class, 'index'])->name('admin.plan-type')->middleware(['adminManagers:plan_type_view']);

		Route::get('/plan-type/create', [PlanTypeController::class, 'create'])->name('admin.plan-type.create')->middleware(['adminManagers:plan_type_add']);

		Route::get('/plan-type/edit/{id}', [PlanTypeController::class, 'edit'])->name('admin.plan-type.edit')->middleware(['adminManagers:plan_type_edit']);

		Route::delete('/plan-type/delete/{id}', [PlanTypeController::class, 'destroy'])->name('admin.plan-type.delete')->middleware(['adminManagers:plan_type_delete']);

		Route::post('/plan-type/store', [PlanTypeController::class, 'store'])->name('admin.plan-type.store')->middleware(['adminManagers:plan_type_add']);



		Route::post('/plan-type/block/{id}/{status}', [PlanTypeController::class, 'block'])->name('admin.plan-type.block')->middleware(['adminManagers:plan_type_delete']);



		/* blog */

		Route::get('categories', [CategoriesController::class, 'index'])->middleware(['adminManagers:blog_categories_view']);

		Route::get('categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create')->middleware(['adminManagers:blog_categories_add']);

		Route::post('categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store')->middleware(['adminManagers:blog_categories_add']);

		Route::get('categories/{id}', [CategoriesController::class, 'edit'])->middleware(['adminManagers:categories_edit']);

		Route::delete('categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.delete')->middleware(['adminManagers:blog_categories_delete']);

		Route::post('/categories/update', [CategoriesController::class, 'update'])->name('admin.categories.update')->middleware(['adminManagers:blog_categories_edit']);



		Route::get('blog', [BlogController::class, 'index'])->name('admin.blog')->middleware(['adminManagers:blogs_view']);

		Route::get('blog/create', [BlogController::class, 'create'])->name('admin.blog.create')->middleware(['adminManagers:blogs_add']);

		Route::get('blog/{id}', [BlogController::class, 'edit'])->middleware(['adminManagers:blogs_edit']);

		Route::delete('blog/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete')->middleware(['adminManagers:blogs_delete']);

		Route::post('blog/store', [BlogController::class, 'store'])->name('admin.blog.store')->middleware(['adminManagers:blogs_add']);

		Route::post('blog/ck-upload', [BlogController::class, 'ckUploadImage'])->name('admin.blog.ckupload')->middleware(['adminManagers:blogs_add']);



		/* Role */



		Route::post('roles/delete/', [RolesController::class, 'delete'])->name('admin.roles.delete')->middleware(['adminManagers:roles_delete']);

		Route::post('roles/store', [RolesController::class, 'store'])->name('admin.roles.store')->middleware(['adminManagers:roles_add']);



		Route::get('permission', [PermissionController::class, 'index'])->name('admin.permission')->middleware(['adminManagers:permission_view']);

		Route::get('permission/create', [PermissionController::class, 'create'])->name('admin.permission.create')->middleware(['adminManagers:permission_add']);

		Route::get('permission/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit')->middleware(['adminManagers:permission_edit']);

		Route::delete('permission/delete/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.delete')->middleware(['adminManagers:permission_delete']);

		Route::post('permission/store', [PermissionController::class, 'store'])->name('admin.permission.store')->middleware(['adminManagers:permission_add']);







		Route::get('/menu', [ManagePageController::class, 'menu'])->name('admin.menu')->middleware(['adminManagers:menu_add']);

		Route::post('/menu-create', [ManagePageController::class, 'menuCreate'])->name('admin.menu-create')->middleware(['adminManagers:menu_add']);



		Route::group(['prefix' => 'affirmation'],function(){

			Route::get('/', [AffirmationController::class, 'index'])->name('admin.affirmation')->middleware(['adminManagers:affirmation_view']);

			Route::get('/create', [AffirmationController::class, 'create'])->name('admin.affirmation.create')->middleware(['adminManagers:affirmation_add']);

			Route::get('/edit/{id}', [AffirmationController::class, 'edit'])->name('admin.affirmation.edit')->middleware(['adminManagers:affirmation_edit']);

			Route::post('/store', [AffirmationController::class, 'store'])->name('admin.affirmation.store')->middleware(['adminManagers:affirmation_add']);



			Route::delete('/delete/{id}', [AffirmationController::class, 'delete'])->name('admin.affirmation.delete')->middleware(['adminManagers:affirmation_delete']);



			Route::get('/type', [AffirmationController::class, 'type'])->name('admin.affirmation.type')->middleware(['adminManagers:affirmation_view']);

			Route::get('/type-create', [AffirmationController::class, 'typeCreate'])->name('admin.affirmation.type.create')->middleware(['adminManagers:affirmation_add']);

			Route::get('/type-edit/{id}', [AffirmationController::class, 'typeEdit'])->name('admin.affirmation.type.edit')->middleware(['adminManagers:affirmation_edit']);

			Route::post('/type-store', [AffirmationController::class, 'typeStore'])->name('admin.affirmation.type.store')->middleware(['adminManagers:affirmation_add']);



		});





	});

});



Route::group(['middleware' => ['auth', 'xss_protection', 'affiliate']], function ($router) {

	Route::group(['prefix' => 'affiliate', 'namespace' => 'affiliate'], function () {

		Route::get('/', function () {

			return redirect('/dashboard');

		});

		Route::get('/dashboard', [AffiliateDashboardController::class, 'index'])->name('affiliate-dashboard');

		Route::get('/transaction', [AffiliateTransactionController::class, 'index']);

		Route::get('/student', [AffiliateUserController::class, 'list'])->name('affiliate.student');

		Route::post('/import-subscriber', [AffiliateUserController::class, 'importSubscriber'])->name('affilate.import-subscriber');



		Route::get('/student/show/{user}', [AffiliateUserController::class, 'show'])->name('affiliate.student.view');

		Route::get('/student/edit/{user}', [AffiliateUserController::class, 'edit'])->name('affiliate.student.edit');



		//Route::get('/student'[AffiliateTransactionController::class, 'index'])



	});

});



Route::group(['middleware' => ['auth', 'xss_protection', 'counsellor']], function ($router) {

	Route::group(['prefix' => 'counsellor', 'namespace' => 'counsellor'], function () {

		Route::get('/', function () {

			return redirect('/dashboard');

		});

		Route::get('/dashboard', [CounsellorDashboardController::class, 'index'])->name('counsellor-dashboard');

		Route::get('/sessions', [SessionController::class, 'getAllSessions']);

		Route::get('/sessions/{id}', [SessionController::class, 'viewSessionDetails']);

	});

});





Route::group(['middleware' => 'AWMIpricing'], function () {

    Route::get('/tele-counseling', [CounselingController::class, 'teleCounseling']);

	Route::get('/counseling', [CounselingController::class, 'counseling']);

});



//  new route added on 24-04-2024

Route::get('/account-deactivate', [AppController::class, 'accountDeactivate']);



// new routes for mobile 



Route::get('/login-otp', [UserController::class, 'loginWithOtp'])->name('loginWithOtp');

Route::post('/checkPhoneExist', [UserController::class, 'checkPhoneExist']);

Route::post('/sendPhoneOtp', [UserController::class, 'sendPhoneOtp']);

Route::post('/sendPasscode', [UserController::class, 'sendPasscode']);

Route::post('/validateOtpCode', [UserController::class, 'validateOtpCode']);

Route::post('/acceptTermsAndStore', [UserController::class, 'acceptTermsAndStore']);

Route::post('/submitRegisterFinal', [UserController::class, 'submitRegisterFinal']);



Route::post('/resendOtp', [UserController::class, 'resendOtp']);

Route::post('/resendOtpSignUp', [UserController::class, 'resendOtpSignUp']);

Route::post('/loginSendPhoneOtp', [UserController::class, 'loginSendPhoneOtp']);

Route::post('/loginValidateOtpCode', [UserController::class, 'loginValidateOtpCode']);

Route::get('/secure-auto-login-token', [UserController::class, 'autoLogin']);



Route::group(['middleware' => ['auth', 'web_user','UserDashboardPaymentStatus']], function ($router) {

	Route::group(['middleware' => ['MobileViewVerifySteps:plan-package-completed']], function ($router) {



		Route::get('mobile-dashboard',[HomeController::class, 'MobileUserDashboard'])->name("mobile-dashboard");

		Route::get('mobile-setting-profile',[HomeController::class, 'MobileUserSettingProfile']);

		Route::get('mobile-setting',[HomeController::class, 'MobileUserSetting']);

		

		

		

		

		Route::post('my-mood-feeling-history-logs',[UserMoodController::class, 'moodLogs'])->name('my-mood-feeling-history-logs');

		



	

		Route::get('view-journal-log',[JournalController::class, 'ViewJournalLog'])->name('view-journal-log');

		

		

		

		

		

		Route::get('talk-to-therapist',[UserMoodController::class, 'behavioralHealth'])->name('talk-to-therapist');



		



		

		

		Route::get('pet-health',[PetController::class, 'pets'])->name('pet-health');

		Route::get('pet-health-add',[PetController::class, 'petsAdd'])->name('pet-health-add');

		Route::get('pet-health-edit',[PetController::class, 'petsEdit'])->name('pet-health-edit');

		Route::post('pet-health-save',[PetController::class, 'store'])->name('pet-health-save');

		

		

		

		//Route::get('/uploadFileToFtp', [VJController::class, 'uploadFileToFtp']);

		

		

		

		

		

		

	});





	Route::get('/mental-health-screening', [AppController::class, 'mentalHealthScreening'])->name('mental-health-screening');

	Route::get('mobile-onboard',[HomeController::class, 'MobileUserOnBoard'])->name("mobile-onboard")->middleware('MobileViewVerifySteps:mobile-step-1');

	Route::post('mobile-onboard',[HomeController::class, 'saveOnBoard'])->name("saveOnBoard");

	Route::get('mobile-plan',[HomeController::class, 'MobileUserPlans'])->name("MobileUserPlans")->middleware('MobileViewVerifySteps:mobile-step-2');

	















Route::get('/my-account', [UserController::class, 'profile'])->middleware(['UserDashboardPaymentStatus'])->name('my-account');





Route::get('change-plan',[HomeController::class, 'MobileUserPlans'])->name("MobileUserChangePlans"); // Change Plan

Route::get('my-safety-plan',[SafetyController::class, 'index'])->middleware(['UserDashboardPaymentStatus'])->name('my-safety-plan');

Route::post('my-safety-plan-save',[SafetyController::class, 'store'])->name('my-safety-plan-save');



Route::get('what-is-mood',[HomeController::class, 'WhatIsMood'])->middleware(['UserDashboardPaymentStatus'])->name('what-is-mood');



Route::get('my-mood-feeling-history-graph',[GraphController::class, 'feelingHistoryGraph'])->middleware(['UserDashboardPaymentStatus'])->name('my-mood-feeling-history-graph');

Route::get('my-screening-history-graph',[GraphController::class, 'screeningHistoryGraph'])->middleware(['UserDashboardPaymentStatus'])->name('my-screening-history-graph');



Route::get('my-mood-feeling',[UserMoodController::class, 'index'])->middleware(['UserDashboardPaymentStatus'])->name('my-mood-feeling');

Route::post('my-mood-feeling-save',[UserMoodController::class, 'myMoodFeelingSave'])->name('my-mood-feeling-save');



Route::get('cbt-therapy',[CBTController::class, 'index'])->middleware(['UserDashboardPaymentStatus'])->name('cbt-therapy');

Route::post('cbt-therapy-save',[CBTController::class, 'store'])->name('cbt-therapy-save');

Route::post('cbt/get-reflection',[CBTController::class, 'cbtGetRefection'])->name('cbt-get-reflection');

Route::post('cbt/cbt-content-load',[CBTController::class, 'cbtContentLoad'])->name('cbt-content-load');



Route::get('cbt-therapy-list',[CBTController::class, 'list'])->name('cbt-therapy-list');

Route::post('cbt-therapy-deleted',[CBTController::class, 'delete'])->name('cbt-therapy-deleted');

Route::post('cbt-therapy-list-view',[CBTController::class, 'cbtView'])->name('cbt-therapy-list-view');

Route::post('mood-feeling-list-view',[UserMoodController::class, 'ViewFeeling'])->name('mood-feeling-list-view');  

Route::get('cbt-therapy-edit',[CBTController::class, 'edit'])->name('cbt-therapy-edit');



Route::get('my-journal-written',[JournalController::class, 'mobileIndex'])->name('my-journal-written');

Route::post('my-journal-written-save',[JournalController::class, 'store'])->name('my-journal-written-save');



Route::get('my-journal-audio',[VJController::class, 'index'])->middleware(['UserDashboardPaymentStatus'])->name('my-journal-audio');

Route::get('journal-affirmation',[VJController::class, 'index'])->name('journal-affirmation');

Route::get('/requested-affirmation', [VJController::class, 'requestedAffirmation'])->middleware(['UserDashboardPaymentStatus'])->name('requested-affirmation');



Route::match(['post', 'delete'], '/my-journal-audio-deleted/{id}', [VJController::class, 'deleteRecording'])

    ->name('my-journal-audio-deleted');

	

/* Route::delete('/my-journal-audio-deleted/{id}',[VJController::class,'deleteRecording'])->name('my-journal-audio-deleted');

Route::post('/my-journal-audio-deleted/{id}',[VJController::class,'deleteRecording'])->name('my-journal-audio-deleted'); */

 

Route::get('journal',[JournalController::class, 'index'])->middleware(['UserDashboardPaymentStatus'])->name('journal');

Route::post('journal-deleted',[JournalController::class, 'journalDeleted'])->middleware(['UserDashboardPaymentStatus'])->name('journal-deleted');

Route::get('view-journal-log',[JournalController::class, 'ViewJournalLog'])->name('view-journal-log');



Route::post('view-journal-log-post-deleted',[JournalController::class, 'destroyMobile'])->name('view-journal-log-post-deleted');

Route::post('/voice-journal/send-link', [VJController::class, 'shareLinkViaProvider']);

Route::get('my-mood-feeling-history',[UserMoodController::class, 'MyMoodFeelingHistory'])->name('my-mood-feeling-history');

Route::get('feels/mood-logs',[UserMoodController::class, 'moodLogs']);

Route::post('my-mood-feeling-history-deleted',[UserMoodController::class, 'moodDelete'])->name('my-mood-feeling-history-deleted');

});

Route::get('/signup-promo', function (Request $request) {})->middleware('TrackUtmSession')->name('signup.promo');

Route::post('view-journal-log-post',[JournalController::class, 'journalLogs'])->name('view-journal-log-post');

Route::post('store-save-mode-message',[JournalController::class, 'store'])->name('store-save-mode-message');

Route::post('pet-schedule-save',[PetController::class, 'schedule'])->name('pet-schedule-save');

Route::get('/voice-journal/{token}', [VJController::class, 'vjShare']);

Route::post('/upload-audio', [VJController::class, 'uploadAudio']);


Route::get('/general-information/{type}',[GeneralInformationController::class, 'index']);

Route::post('/general-information/{type}',[GeneralInformationController::class, 'index']);

