<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class)->middleware('can:manage-role');
    Route::resource('products', ProductController::class);
    Route::middleware(['auth','admin'])->group(function(){ 
        Route::resource('users', UserController::class)->middleware('can:manage-users');
    });
    
    

});