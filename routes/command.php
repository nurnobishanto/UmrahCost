<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::prefix('command')->group(function (){

    Route::get('/clear-cache', function (){
        App::setLocale(session('locale'));
        Artisan::call('cache:clear');
        return __('notification.cache_cleared');
    });
    Route::get('/clear-config', function (){
        App::setLocale(session('locale'));
        Artisan::call('config:clear');
        return  __('notification.config_cleared');
    });
    Route::get('/clear-route', function (){
        App::setLocale(session('locale'));
        Artisan::call('route:clear');
        return __('notification.route_cleared');
    });
    Route::get('/optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize');
        return __('notification.optimized');
    });
    Route::get('/clear-optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize:clear');
        return __('notification.optimized');
    });
    Route::get('/migrate', function (){
        App::setLocale(session('locale'));
        Artisan::call('migrate');
        return __('notification.migrated');
    });

});
