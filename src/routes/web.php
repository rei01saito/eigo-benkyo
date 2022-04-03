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

// UserController
Route::get('/mypage', [UserController::class, 'index'])->name('mypage');

// StatusController
Route::get('/status', [StatusController::class, 'index'])->name('status');

// TasksController
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/softDelete/{id}', [TaskController::class, 'softDelete'])->name('tasks-softDelete');
Route::get('/tasks/trashcan', [TaskController::class, 'trashcan'])->name('trashcan');
Route::get('/tasks/restore', [TaskController::class, 'restore'])->name('restore');
Route::get('/tasks/forceDelete', [TaskController::class, 'forceDelete'])->name('forceDelete');
Route::get('/tasks/update/{id}/{priority_id}', [TaskController::class, 'update'])->name('tasks-update');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks-store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
