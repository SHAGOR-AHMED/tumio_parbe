<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminController;

//reboot system
Route::get("/reboot",function(){
    Artisan::call("config:clear");
    Artisan::call("config:cache");
    Artisan::call("cache:clear");
    Artisan::call("route:clear");
    Artisan::call("view:clear");
    file_put_contents(storage_path("logs/laravel.log"),'');
    return '<center><h1>System Rebooted!</h1></center>';
});

Route::get('/', function () {
    return view('welcome');
});

//backend route
// Route::get('login/admin', [AdminController::class,'adminLoginForm'])->name('admin.login.form');
// Route::post('admin-login', [AdminController::class,'adminLogin'])->name('admin.login');

// Route::group(['middleware'=>'admin'], function(){
//     Route::get('admin/dashboard', [DashboardController::class,'adminDashboard'])->name('admin.dashboard');
//     Route::get('admin/logout', [AdminController::class,'adminLogout'])->name('admin.logout');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
