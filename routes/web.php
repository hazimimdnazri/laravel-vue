<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestController::class, 'index']);
Route::get('logout', [GuestController::class, 'submitLogout'])->name('logout')->middleware('auth');

Route::group(['middleware' => ['guest'], 'prefix' => 'guest'], function(){
    Route::get('login', [GuestController::class, 'login'])->name('login');
    Route::post('login', [GuestController::class, 'submitLogin']);
    Route::get('register', [GuestController::class, 'register']);
    Route::post('register', [GuestController::class, 'submitRegister']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', [UserController::class, 'dashboard']);

    Route::group(['prefix' => 'tasks'], function(){
        Route::get('/', [TaskController::class, 'tasks']);
        Route::post('modal-task', [TaskController::class, 'modalTask']);
        Route::post('store-task', [TaskController::class, 'storeTask']);
    });

    Route::group(['prefix' => 'ajax'], function(){
        Route::post('modal-password', [UserController::class, 'modalPassword']);
        Route::post('change-password', [UserController::class, 'changePassword']);
    });
});