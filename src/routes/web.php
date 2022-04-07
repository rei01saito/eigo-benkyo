<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

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

// HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/{id}', [HomeController::class, 'setTimer'])->name('setTimer');

// TaskController, StatusController,UserController
Route::middleware(['auth'])->group(function() {
    Route::controller(TaskController::class)->group(function() {
        Route::get('/tasks', 'index')->name('tasks');
        Route::post('/tasks/softDelete/{id}', 'softDelete')->name('tasks-softDelete'); // postにする必要ないので後修正
        Route::get('/tasks/trashcan', 'trashcan')->name('trashcan');
        Route::get('/tasks/restore', 'restore')->name('restore');
        Route::get('/tasks/forceDelete', 'forceDelete')->name('forceDelete');
        Route::get('/tasks/update/{id}/{priority_id}', 'update')->name('tasks-update');
        Route::post('/tasks/store', 'store')->name('tasks-store');
    });

    Route::get('/status', [StatusController::class, 'index'])->name('status');

    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
