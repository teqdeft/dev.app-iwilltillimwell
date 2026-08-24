<?php
use Illuminate\Support\Facades\Route;

Route::get('/terms-of-use','PagesController@termsOfUse')->name('terms-of-use');
Route::get('/hippa-privacy-policy', 'PagesController@hippaPrivacyPolicy')->name('hippa-privacy-policy');
Route::get('/updateCompleteSetup', 'PagesController@updateCompleteSetup')->name('updateCompleteSetup');
