<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    // HomeController
    Route::controller(HomeController::class)->group(function() {
        Route::get('/home/{id}', 'setTimer')->name('setTimer');
        Route::get('/home/incrementNExec/{id}', 'incrementNExec')->name('home-incrementNExec');
    });

    // TargetController
    Route::controller(TargetController::class)->group(function() {
        Route::get('/targets', 'index')->name('targets');
        Route::get('/targets/create', 'create')->name('targets-create');
        Route::post('/targets/store', 'store')->name('targets-store');
        Route::get('/targets/{id}', 'edit')->name('targets-edit');
        Route::post('/targets/{id}', 'update')->name('targets-update');
        Route::get('/targets/accomplish/destroy/{id}', 'destroy')->name('targets-destroy');
        Route::get('/targets/accomplish/{id}', 'accomplish')->name('targets-accomplish');
    });

    // TaskController
    Route::controller(TaskController::class)->group(function() {
        Route::get('/tasks', 'index')->name('tasks');
        Route::post('/tasks/softDelete/{id}', 'softDelete')->name('tasks-softDelete');
        Route::post('/tasks/store', 'store')->name('tasks-store');
        Route::post('/tasks/{id}', 'update')->name('tasks-update');
        Route::get('/tasks/trashcan', 'trashcan')->name('trashcan');
        Route::get('/tasks/restore', 'restore')->name('restore');
        Route::get('/tasks/forceDelete', 'forceDelete')->name('forceDelete');
        Route::get('/tasks/update/{id}/{priority_id}', 'dragUpdate')->name('tasks-drag-update');
    });

    // UserController
    Route::controller(UserController::class)->group(function() {
        Route::get('/mypage', 'index')->name('mypage');
        Route::get('/mypage/edit', 'edit')->name('mypage-edit');
        Route::post('/mypage/update', 'update')->middleware(['can:generalAndAdmin'])->name('mypage-store');
        Route::get('/mypage/destroy', 'destroy')->middleware(['can:generalAndAdmin'])->name('mypage-destroy');
    });

    // TagController
    Route::controller(TagController::class)->group(function() {
        Route::get('/mypage/tag/delete', 'tagDelete')->name('mypage-tag-delete');
        Route::post('/mypage/tag/store', 'tagStore')->name('mypage-tag-store');
    });
});

Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('/guest_login', [AuthenticatedSessionController::class, 'guestLogin'])->name('guest-login');

require __DIR__.'/auth.php';
