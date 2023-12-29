<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::prefix('command')->group(function (){

    Route::get('/clear-cache', function (){
        App::setLocale(session('locale'));
        Artisan::call('cache:clear');
        return Artisan::output();
    });
    Route::get('/clear-config', function (){
        App::setLocale(session('locale'));
        Artisan::call('config:clear');

        return Artisan::output();
    });
    Route::get('/clear-route', function (){
        App::setLocale(session('locale'));
        Artisan::call('route:clear');
        return Artisan::output();
    });
    Route::get('/optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize');
        return Artisan::output();
    });
    Route::get('/clear-optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize:clear');
        return Artisan::output();
    });
    Route::get('/migrate', function (){
        App::setLocale(session('locale'));
        Artisan::call('migrate');
        return Artisan::output();
    });
});
