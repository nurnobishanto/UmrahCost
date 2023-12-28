<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ClientSourceController;
use App\Http\Controllers\Admin\ClientStatusController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CRMController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageTypeController;
use App\Http\Controllers\Admin\QueryAboutController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\SettingContgroller;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\ClientFeedbackController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomPackageController;
use App\Http\Controllers\Admin\GuideController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SightseeingController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\ServiceVoucherController;
use App\Http\Controllers\Admin\ServiceVoucherSettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['auth', 'webAdmin']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('change/password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::post('change/password/update', [ProfileController::class, 'changePasswordUpdate'])->name('changePassword.update');
    Route::get('edit/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // for client Source
    Route::resource('clientSource', ClientSourceController::class);
    Route::group(['prefix' => 'clientSource/', 'as' => 'clientSource.'], function () {
        Route::post('status-change', [ClientSourceController::class, 'statusChange'])->name('status.change');
    });
    // for client Feedback
    Route::resource('clientFeedback', ClientFeedbackController::class);
    Route::group(['prefix' => 'clientFeedback/', 'as' => 'clientFeedback.'], function () {
        Route::post('status-change', [ClientFeedbackController::class, 'statusChange'])->name('status.change');
    });
    
    // for query About
    Route::resource('queryAbout', QueryAboutController::class);
    Route::group(['prefix' => 'queryAbout/', 'as' => 'queryAbout.'], function () {
        Route::post('status-change', [QueryAboutController::class, 'statusChange'])->name('status.change');
    });
    
    // for status
    Route::resource('status', StatusController::class);
    Route::group(['prefix' => 'status/', 'as' => 'status.'], function () {
        Route::post('status-change', [StatusController::class, 'statusChange'])->name('status.change');
    });

    // for client Status
    Route::resource('clientStatus', ClientStatusController::class);
    Route::group(['prefix' => 'clientStatus/', 'as' => 'clientStatus.'], function () {
        Route::post('status-change', [ClientStatusController::class, 'statusChange'])->name('status.change');
    });

    // for Currency
    Route::resource('currency', CurrencyController::class);
    Route::group(['prefix' => 'currency/', 'as' => 'currency.'], function () {
        Route::post('status-change', [CurrencyController::class, 'statusChange'])->name('status.change');
    });
    // for Package
    Route::resource('package', PackageController::class);
    Route::group(['prefix' => 'package/', 'as' => 'package.'], function () {
        Route::post('status-change', [PackageController::class, 'statusChange'])->name('status.change');
    });

    // for Package Type
    Route::resource('packageType', PackageTypeController::class);
    Route::group(['prefix' => 'packageType/', 'as' => 'packageType.'], function () {
        Route::post('status-change', [PackageTypeController::class, 'statusChange'])->name('status.change');
    });

    // for client Status
    Route::resource('roomType', RoomTypeController::class);
    Route::group(['prefix' => 'roomType/', 'as' => 'roomType.'], function () {
        Route::post('status-change', [RoomTypeController::class, 'statusChange'])->name('status.change');
    });

    // for Location
    Route::resource('location', LocationController::class);
    Route::group(['prefix' => 'location/', 'as' => 'location.'], function () {
        Route::post('status-change', [LocationController::class, 'statusChange'])->name('status.change');
    });
    
    // for Sightseeing
    Route::resource('sightseeing', SightseeingController::class);
    Route::group(['prefix' => 'sightseeing/', 'as' => 'sightseeing.'], function () {
        Route::post('status-change', [SightseeingController::class, 'statusChange'])->name('status.change');
    });

    // for Transport
    Route::resource('transport', TransportController::class);
    Route::group(['prefix' => 'transport/', 'as' => 'transport.'], function () {
        Route::post('status-change', [TransportController::class, 'statusChange'])->name('status.change');
    });
    
    // for Guide
    Route::resource('guide', GuideController::class);
    Route::group(['prefix' => 'guide/', 'as' => 'guide.'], function () {
        Route::post('status-change', [GuideController::class, 'statusChange'])->name('status.change');
    });

    // for Airline
    Route::resource('airline', AirlineController::class);
    Route::group(['prefix' => 'airline/', 'as' => 'airline.'], function () {
        Route::post('status-change', [AirlineController::class, 'statusChange'])->name('status.change');
    });

    // for Hotel
    Route::resource('hotel', HotelController::class);
    Route::group(['prefix' => 'hotel/', 'as' => 'hotel.'], function () {
        Route::post('status-change', [HotelController::class, 'statusChange'])->name('status.change');
    });

    // for CRM
    Route::resource('crm', CRMController::class);
    Route::group(['prefix' => 'crm/', 'as' => 'crm.'], function () {
        Route::post('status-change', [CRMController::class, 'statusChange'])->name('status.change');
    });

    // for Client
    Route::resource('client', ClientController::class);
    Route::group(['prefix' => 'client/', 'as' => 'client.'], function () {
        // Route::post('status-change', [ClientController::class, 'statusChange'])->name('status.change');
        Route::get('package-create/{client_id}', [ClientController::class, 'packageCreate'])->name('package.create');
        Route::post('package-store/{client_id}', [ClientController::class, 'packageStore'])->name('package.store');
    });
    
    // for customPackage
    Route::resource('customPackage', CustomPackageController::class);
    Route::group(['prefix' => 'customPackage/', 'as' => 'customPackage.'], function () {
        Route::get('send-invoice-to-user/{id}', [CustomPackageController::class, 'sendInvoiceToUser'])->name('sendInvoiceToUser');
        Route::get('change-status/{id}/{status_id}', [CustomPackageController::class, 'changeStatus'])->name('changeStatus');
    });
    
    // for serviceVoucher
    Route::resource('serviceVoucher', ServiceVoucherController::class);
    Route::group(['prefix' => 'service-voucher/', 'as' => 'serviceVoucher.'], function () {
        Route::get('delete-element/{type}/{id}/{voucher_id}', [ServiceVoucherController::class, 'deleteElementById'])->name('delete.element');
    });

    // for serviceVoucherSetting
    Route::resource('serviceVoucherSetting', ServiceVoucherSettingController::class);
    Route::group(['prefix' => 'service-voucher-setting/', 'as' => 'serviceVoucherSetting.'], function () {
        Route::get('delete-element/{type}/{key}', [ServiceVoucherSettingController::class, 'deleteElementByKey'])->name('delete.element');
    });

    // for Role
    Route::group(['prefix' => 'role/', 'as' => 'role.'], function () {
        Route::get('index', [RoleController::class, 'index'])->name('index');
        Route::get('edit/{role_id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('update', [RoleController::class, 'update'])->name('update');
    });

    // for setting
    Route::group(['prefix' => 'setting/', 'as' => 'setting.'], function () {
        Route::get('information', [SettingContgroller::class, 'information'])->name('information');
        Route::post('information-update', [SettingContgroller::class, 'informationUpdate'])->name('informationUpdate');
    });
});
