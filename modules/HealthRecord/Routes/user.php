<?php
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth', 'web_user','CompleteProfileCheck'] ],function () {
    Route::post('/medication-allergy-inactive', 'HealthRecordController@medicationAllergyInactive')->where('allergyId', '[0-9]+');
    Route::get('/load-personal-popup/{user}', 'HealthRecordController@personalPopup')->where('user', '[0-9]+');
    Route::post('/store-medication/{user}', 'HealthRecordController@storeMedication')->name('store.medication');
    Route::get('/search-medication', 'HealthRecordController@searchMedication');
    Route::post('/not-take-medication/{user}', 'HealthRecordController@NottakeMedication')->name('store.NottakeMedication');
    Route::get('/search-medication-allergy', 'HealthRecordController@searchMedicationAllergy');
    Route::post('/store-medication-allergy/{user}', 'HealthRecordController@storeMedicationAllergy')->name('store.medication.allergy');
    Route::post('/medication-inactive', 'HealthRecordController@medicationInactive')->where('medication', '[0-9]+');
    
	Route::post('/medication-allergies/delete', 'HealthRecordController@medicationAllergiesDelete');
	Route::post('/medication-details/delete', 'HealthRecordController@medicationDetailsDelete');
    
	Route::post('/store-medical-condition/{user}', 'HealthRecordController@storeMedicalCondition')->name('store.medicalcondition');
    Route::get('/medical-history/{user?}', 'HealthRecordController@medicalHistory');
    Route::post('/medical-history-inactive/{medicalConditionId}/{user}', 'HealthRecordController@medicalHistoryInactive')->where('medicalConditionId', '[0-9]+');
    Route::delete('/medical-history-inactive/{medicalConditionId}/{user}', 'HealthRecordController@medicalHistoryInactive')->where('medicalConditionId', '[0-9]+');
   
    Route::get('/load-history-popup/{condition}', 'HealthRecordController@medicalHistoryPopup')->where('condition', '[0-9]+');
    Route::post('/medical-history-update/{medicalConditionId}', 'HealthRecordController@medicalHistoryUpdate')->name('update.medical.history');
    Route::post('/delete-document/{document?}', 'HealthRecordController@deleteDocument')->name('documents.destroy');
    
    Route::post('/update-personal-info/{user}', 'HealthRecordController@updatePersonalInfo')->name('update.personal.info');	  
	
	Route::post('/surgical-history-deleted', 'HealthRecordController@surgicalhistorydeleted')->name('surgical-history-deleted');
	
	Route::post('/save-surgical-data', 'HealthRecordController@saveSurgicalData')->name('save-surgical-data');
	
	
    Route::post('/upload-document/{user?}', 'HealthRecordController@uploadDocument')->name('upload-document');
    Route::get('/upload-document/{user?}', 'HealthRecordController@uploadDocument')->name('upload-document');

    Route::get('/personal-record/{user?}','HealthRecordController@personalRecord')->name("personal-record");
    Route::get('/medications/{user?}', 'HealthRecordController@medications');
    Route::get('/medication-allergies/{user?}', 'HealthRecordController@medicationAllergies');
    Route::get('/document-manager/{user?}', 'HealthRecordController@documentManager');
    Route::get('/surgical-conditions/{user?}', 'HealthRecordController@SurgicalConditions');
});
Route::post('/member-update-token-number', 'HealthRecordController@memberAuthTokenUpdate')->name('memberAuthTokenUpdate');
