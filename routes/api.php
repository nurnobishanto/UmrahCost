<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\RegsiterController;
use App\Http\Controllers\Api\CustomPackageController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1/'], function () {
    // authentication related api
    Route::post('register', [RegsiterController::class, 'register']);
    Route::post('otp-verify', [RegsiterController::class, 'otpVerify']);
    Route::post('login', [LoginController::class, 'login']);

    Route::post('/forgot-password', [App\Http\Controllers\Api\UserController::class, 'forgotPassword']);
    Route::post('/forgot-password-update', [App\Http\Controllers\Api\UserController::class, 'forgotPasswordUpdate']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', [App\Http\Controllers\Api\LoginController::class, 'logout']);

        Route::post('/reset-password', [App\Http\Controllers\Api\UserController::class, 'resetPassword']);
        Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'userInfo']);
        Route::post('/profile-update', [App\Http\Controllers\Api\UserController::class, 'profileUpdate']);
        Route::post('/parmanently-delete-account', [App\Http\Controllers\Api\UserController::class, 'parmanentlyDeleteAccount']);       

        // client related api
        Route::group(['prefix' => 'custom-package/'], function () {
            Route::get('index', [CustomPackageController::class, 'index']);
            Route::post('store', [CustomPackageController::class, 'store']);
            Route::get('show/{id}', [CustomPackageController::class, 'show']);
        });
    });


    // global apis
    Route::get('/custom-package/initial-data', [OtherController::class, 'customPackageInnitialData']);
    Route::get('/hotel-by-package-type-and-location/{package_type_id}/{location_id}', [OtherController::class, 'hotelByPackageTypeAndLocation'])->name('hotelByPackageTypeAndLocation');
    Route::get('/room-type-by-traveler-and-hotel/{nos_of_traveler}/{hotel_id}', [OtherController::class, 'roomTypeByTravelerAndHotel'])->name('roomTypeByTravelerAndHotel');
});
