<?php

use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\CreatedPackageController;
use App\Http\Controllers\Frontend\CustomPackageController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

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
Route::post('rt/import', [RoomTypeController::class, 'import'])->name('room_type.import');
Route::get('rt/export', [RoomTypeController::class, 'export_xl'])->name('room_type.export');
Route::get('hotel/export/{id}', [RoomTypeController::class, 'hotel_export_xl'])->name('hotel.export');
Route::get('redirect-to-dashboard', [HomeController::class, 'redirectToDashboard'])->name('redirectToDashboard');
Route::post('user-otp-verify', [HomeController::class, 'user_otp_verify'])->name('user_otp_verify');

Route::get('login', [AuthController::class,'login_view'])->name('web.login_view');
Route::post('login', [AuthController::class,'login'])->name('web.login');
Route::get('register', [AuthController::class,'register_view'])->name('web.register_view');
Route::post('register', [AuthController::class,'register'])->name('web.register');
Route::get('otp-verify', [AuthController::class,'register_verify'])->name('web.register_verify');
Route::get('resend-otp', [AuthController::class,'resend_otp'])->name('web.resend_otp');
Route::post('otp-verify', [AuthController::class,'verifyOtp'])->name('web.verifyOtp');
Route::post('logout', [AuthController::class,'logout'])->name('web.logout');
Route::get('password-reset', [AuthController::class,'resetPasswordView'])->name('web.resetPasswordView');
Route::post('password/reset', [AuthController::class,'resetPassword'])->name('web.resetPassword');
Route::get('password/change', [AuthController::class,'passwordChange'])->name('web.passwordChange');
Route::post('verify-otp-change-pass', [AuthController::class,'verify_otp_change_pass'])->name('web.verify_otp_change_pass');





Route::group(['as' => 'frontend.',], function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('index');

    Route::post('/user-register', [LandingPageController::class, 'userRegister'])->name('userRegister');
    Route::get('/user-register-otp-form', [LandingPageController::class, 'userRegisterOtpForm'])->name('userRegisterOtpForm');
    Route::post('/user-register-otp-verify', [LandingPageController::class, 'userRegisterOtpVarify'])->name('userRegisterOtpVarify');

    Route::group(['as' => 'customPackage.', 'prefix' => 'package/'], function () {
        Route::get('/umrah', [CustomPackageController::class, 'create'])->name('create');
        Route::post('/store', [CustomPackageController::class, 'store'])->name('store');
    });

    Route::group(['as' => 'dashboard.','middleware' => ['auth', 'webClient']], function () {
        Route::resource('createdPackage', CreatedPackageController::class);
        // Route::group(['as' => 'createdPackage.', 'prefix' => 'created-package/'], function () {
        //     Route::get('/umrah', [CustomPackageController::class, 'create'])->name('create');
        // });
    });
});

Route::group(['as' => 'invoice.','prefix' => 'invoice'], function () {
    Route::get('custom-package/invoice/{id}', [InvoiceController::class, 'customPackage'])->name('customPackage');
    Route::get('custom-package/customer-invoice/{id}', [InvoiceController::class, 'customerInvoice'])->name('customerInvoice');
    Route::get('client-preview/{client_id}', [InvoiceController::class, 'clientPreview'])->name('clientPreview');
    Route::get('service-voucher/{id}', [InvoiceController::class, 'serviceVoucher'])->name('serviceVoucher');
});



// ajax part
Route::group(['prefix' => 'ajax/', 'as' => 'ajax.'], function () {
    // Route::get('traveler-number-wise-room/{nos_of_traveler}', [AjaxController::class, 'travelerNumberWiseRoom'])->name('travelerNumberWiseRoom');
    Route::get('hotel-by-package-type-and-location/{package_type_id}/{location_id}', [AjaxController::class, 'hotelByPackageTypeAndLocation'])->name('hotelByPackageTypeAndLocation');
    Route::get('room-type-by-traveler-and-hotel/{nos_of_traveler}/{hotel_id}', [AjaxController::class, 'roomTypeByTravelerAndHotel'])->name('roomTypeByTravelerAndHotel');
    // Route::get('package-wise-package-type/{package_id}', [AjaxController::class, 'packageWisePackageType'])->name('packageWisePackageType');
});

require __DIR__ . '/admin.php';
require __DIR__.'/command.php';
