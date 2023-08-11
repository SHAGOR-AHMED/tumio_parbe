<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminController;

Auth::routes();

/**
 * admin route
 */

Route::namespace('App\Http\Controllers')->group(function(){

    Route::middleware('auth')->namespace('Backend')->prefix('admin')->group(function(){

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        //Course
        Route::namespace('Course')->prefix('course')->group(function(){
            Route::get('/add',                   'IndexController@index')->name('course.add');
            Route::get('/edit/{course_id}',      'IndexController@edit')->name('course.edit');
            Route::post('/store/{course_id?}',   'IndexController@store')->name('course.store');
            Route::get('/destroy/{course_id}',   'IndexController@destroy')->name('course.destroy');
        });

        //Batch
        Route::namespace('Batch')->prefix('batch')->group(function(){
            Route::get('/add',                  'IndexController@index')->name('batch.add');
            Route::get('/edit/{batch_id}',      'IndexController@edit')->name('batch.edit');
            Route::post('/store/{batch_id?}',   'IndexController@store')->name('batch.store');
            Route::get('/destroy/{batch_id}',   'IndexController@destroy')->name('batch.destroy');
        });

        /*user info*/
        Route::namespace('User')->prefix('user')->group(function(){
            Route::get('/add',                 'IndexController@index')->name('admin.user');
            Route::post('/store/{user_id?}',   'IndexController@store')->name('user.store');
            Route::get('/edit/{user_id}',      'IndexController@edit')->name('user.edit');
            Route::get('/destroy/{user_id}',   'IndexController@destroy')->name('user.destroy');
            Route::get('/control/{user_id}',   'IndexController@control')->name('user.control');
            Route::post('change-password',     'IndexController@changePassword')->name('user.change_password');
        });
       
    }); 
});