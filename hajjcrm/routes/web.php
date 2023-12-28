<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CRMController;
use App\Http\Controllers\HotelInfoController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageInfoController;
use App\Http\Controllers\PackageRateController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\FlightInfoController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\SuportCostController;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin/client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/index',[ClientController::class,'index'])->name('index');
    Route::get('/add',[ClientController::class,'create'])->name('create');
    Route::get('/{client}/edit',[ClientController::class,'edit'])->name('edit');
    Route::post('/store',[ClientController::class, 'store'])->name('store');
    Route::post('/{client}/update',[ClientController::class, 'update'])->name('update');
    Route::post('/{client}/destroy',[ClientController::class, 'destroy'])->name('destroy');

});
Route::prefix('admin/client')->name('client.')->group(function () {
    Route::get('/{client}/show',[ClientController::class,'show'])->name('show');
});

    Route::get('admin/packagerate/get/{package_info_id}/{mak_stays}/{mad_satys}/{room}/{flight}',[PackageRateController::class,'getPackageRate']);

Route::prefix('admin/package/info')->name('packageinfo.')->middleware(['auth'])->group(function () {
    Route::get('/index',[PackageInfoController::class,'index'])->name('index');
    Route::get('/add',[PackageInfoController::class,'create'])->name('create');
    Route::get('/{packageInfo}/edit',[PackageInfoController::class,'edit'])->name('edit');
    Route::post('/store',[PackageInfoController::class, 'store'])->name('store');
    Route::post('/{packageInfo}/update',[PackageInfoController::class, 'update'])->name('update');
    Route::post('/{packageInfo}/destroy',[PackageInfoController::class, 'destroy'])->name('destroy');
});
Route::prefix('admin/package/info')->name('packageinfo.')->group(function () {
        Route::get('/{packageInfo}/show',[PackageInfoController::class,'show'])->name('show');
});
Route::prefix('admin/hotelinfo')->name('packageinfo.')->group(function () {
    Route::get('/{city}/{packageInfo_id}',[HotelInfoController::class,'getinfo'])->name('show');
});

Route::prefix('admin/hotel')->name('hotel.')->middleware(['auth'])->group(function () {
    Route::get('/index',[HotelInfoController::class,'index'])->name('index');
    Route::get('/add',[HotelInfoController::class,'create'])->name('create');
    Route::get('/{hotelInfo}/edit',[HotelInfoController::class,'edit'])->name('edit');
    Route::any('/store',[HotelInfoController::class, 'store'])->name('store');
    Route::post('/{hotelInfo}/update',[HotelInfoController::class, 'update'])->name('update');
    Route::post('/{hotelInfo}/destroy',[HotelInfoController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/package')->name('package.')->middleware(['auth'])->group(function () {
    Route::get('/index',[PackageController::class,'index'])->name('index');
    Route::get('/add',[PackageController::class,'create'])->name('create');
    Route::get('/add/{client}',[PackageController::class,'createclient'])->name('createclient');
    Route::get('/{package}/edit',[PackageController::class,'edit'])->name('edit');
    Route::get('/{package}/view',[PackageController::class,'view'])->name('view');
    Route::get('/{package}/pdf',[PackageController::class,'showPdf'])->name('showPdf');
    Route::post('/store',[PackageController::class, 'store'])->name('store');
    Route::post('/{package}/update',[PackageController::class, 'update'])->name('update');
    Route::post('/{package}/destroy',[PackageController::class, 'destroy'])->name('destroy');
});



Route::prefix('admin/crm')->name('crm.')->middleware(['auth'])->group(function () {
    Route::get('/index',[CRMController::class,'index'])->name('index');
    Route::get('/add',[CRMController::class,'create'])->name('create');
    Route::get('/{cRM}/edit',[CRMController::class,'edit'])->name('edit');
    // Route::get('/{cRM}/view',[CRMController::class,'view'])->name('view');
    Route::post('/store',[CRMController::class, 'store'])->name('store');
    Route::post('/{cRM}/update',[CRMController::class, 'update'])->name('update');
    Route::post('/{cRM}/destroy',[CRMController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/source')->name('source.')->middleware(['auth'])->group(function () {
    Route::get('/index',[SourceController::class,'index'])->name('index');
    Route::get('/add',[SourceController::class,'create'])->name('create');
    Route::get('/{source}/edit',[SourceController::class,'edit'])->name('edit');
    // Route::get('/{source}/view',[SourceController::class,'view'])->name('view');
    Route::post('/store',[SourceController::class, 'store'])->name('store');
    Route::post('/{source}/update',[SourceController::class, 'update'])->name('update');
    Route::post('/{source}/destroy',[SourceController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/general-setting')->name('generalsetting.')->middleware(['auth'])->group(function () {
    Route::get('/index',[GeneralSettingsController::class,'index'])->name('index');
    // Route::get('/add',[GeneralSettingsController::class,'create'])->name('create');
    Route::get('/edit/{generalSettings}',[GeneralSettingsController::class,'edit'])->name('edit');
    // Route::post('/store',[GeneralSettingsController::class, 'store'])->name('store');
    Route::post('/update/{generalSettings}',[GeneralSettingsController::class, 'update'])->name('update');
    Route::post('/{generalSettings}/destroy',[GeneralSettingsController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/flight-info')->name('flightInfo.')->middleware(['auth'])->group(function () {
    Route::get('/index',[FlightInfoController::class,'index'])->name('index');
    Route::get('/create',[FlightInfoController::class,'create'])->name('create');
    Route::get('/edit/{flightInfo}',[FlightInfoController::class,'edit'])->name('edit');
    Route::post('/store',[FlightInfoController::class, 'store'])->name('store');
    Route::post('/update/{flightInfo}',[FlightInfoController::class, 'update'])->name('update');
    Route::post('/destroy/{flightInfo}',[FlightInfoController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/transport')->name('transport.')->middleware(['auth'])->group(function () {
    Route::get('/index',[TransportController::class,'index'])->name('index');
    Route::get('/create',[TransportController::class,'create'])->name('create');
    Route::get('/edit/{transport}',[TransportController::class,'edit'])->name('edit');
    Route::post('/store',[TransportController::class, 'store'])->name('store');
    Route::any('/update/{transport}',[TransportController::class, 'update'])->name('update');
    Route::post('/destroy/{transport}',[TransportController::class, 'destroy'])->name('destroy');
});


Route::prefix('admin/support-cost')->name('supportcost.')->middleware(['auth'])->group(function () {
    Route::get('/index',[SuportCostController::class,'index'])->name('index');
    Route::get('/add',[SuportCostController::class,'create'])->name('create');
    Route::get('/{suportCost}/edit',[SuportCostController::class,'edit'])->name('edit');
    Route::any('/store',[SuportCostController::class, 'store'])->name('store');
    Route::any('/{suportCost}/update',[SuportCostController::class, 'update'])->name('update');
    Route::post('/{suportCost}/destroy',[SuportCostController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
