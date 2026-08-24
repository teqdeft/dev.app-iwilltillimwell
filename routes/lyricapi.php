<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LyricApi\LoginController;



Route::get('/lyric/login', [LoginController::class, 'loginForm'])->name('lyric.login');

Route::post('/lyric/login-post', [LoginController::class, 'loginPost'])->name('lyric.login.post');







