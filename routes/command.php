<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::prefix('command')->group(function (){

    Route::get('/clear-cache', function (){
        App::setLocale(session('locale'));
        Artisan::call('cache:clear');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-config', function (){
        App::setLocale(session('locale'));
        Artisan::call('config:clear');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-route', function (){
        App::setLocale(session('locale'));
        Artisan::call('route:clear');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
    Route::get('/optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
    Route::get('/clear-optimize', function (){
        App::setLocale(session('locale'));
        Artisan::call('optimize:clear');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
    Route::get('/migrate', function (){
        App::setLocale(session('locale'));
        Artisan::call('migrate');
        echo "<pre>";
        print_r(Artisan::output()) ;
    });
});
