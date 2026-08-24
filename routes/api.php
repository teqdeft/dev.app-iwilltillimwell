<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthenticateController;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
  

Route::post('login', [AuthenticateController::class, 'login']);
Route::post('forgot-password', [AuthenticateController::class, 'forgotPassword']);
Route::post('/send-otp', [AuthenticateController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthenticateController::class, 'verifyOtp']);
Route::get('/auto-login', [AuthenticateController::class, 'autoLogin']);
Route::middleware('auth:sanctum')->post('/logout', [AuthenticateController::class, 'logout']);