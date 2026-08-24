<?php
use Illuminate\Support\Facades\Route;

Route::get('shareDataToFriend','SharingPreferenceController@shareDataToFriend');
Route::get('share-to-friend/{encrypt}','SharingPreferenceController@shareToMoodScreen');

Route::post('save-user-data','SharingPreferenceController@saveConsentData' );

Route::group(['middleware' => ['auth', 'web_user']], function ($router) {

    Route::post('load-editcontact-form','SharingPreferenceController@loadEditContactForm' );
    Route::post('saveFriendContactData','SharingPreferenceController@saveFriendContactData' );

    Route::get('/user/{type?}', 'SharingPreferenceController@userAccess');
    Route::post('addMailAndPhone','SharingPreferenceController@addMailAndPhone');

    Route::group(['middleware' => ['CompleteProfileCheck']], function ($router) {

        Route::get('/add/{type?}', 'SharingPreferenceController@add');
        Route::get('supporter-add','SharingPreferenceController@SupporterAdd');
        Route::post('deleteFriendContact','SharingPreferenceController@deleteFriendContact');
        /* Route::post('save_module','SharingPreferenceController@save_module' );
        Route::post('shareModuleTime','SharingPreferenceController@shareModuleTime' );
         */
    });
});
