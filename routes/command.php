<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::prefix('command')->group(function (){

    Route::get('/clear-cache', function (){
        App::setLocale(session('locale'));
        Artisan::call('cache:clear');
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-config', function (){
        App::setLocale(session('locale'));
        Artisan::call('config:clear');
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-route', function (){
        App::setLocale(session('locale'));
        Artisan::call('route:clear');
        print_r(Artisan::output()) ;
    });
    Route::get('/optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize');
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize:clear');
        print_r(Artisan::output()) ;
    });
    Route::get('/migrate', function (){
        App::setLocale(session('locale'));
        Artisan::call('migrate');
        print_r(Artisan::output()) ;
    });
});
