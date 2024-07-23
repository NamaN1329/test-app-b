<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Shared\PostController;
use App\Http\Middleware\IsAuthenticate;
use App\Http\Middleware\RedirectIfAuthenticate;
use GuzzleHttp\Promise\Is;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(RedirectIfAuthenticate::class, IsAuthenticate::class);

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware(RedirectIfAuthenticate::class);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => [IsAuthenticate::class]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('manager')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('admin.manager');
        Route::post('/add', [ManagerController::class, 'store'])->name('admin.storeManager');
        Route::post('/edit/{user}', [ManagerController::class, 'update'])->name('admin.updateManager');
        Route::delete('/delete/{user}', [ManagerController::class, 'destroy'])->name('admin.deleteManager');
    });

    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.post');
        Route::post('/add', [PostController::class, 'store'])->name('admin.storePost');
        Route::post('/edit/{post}', [PostController::class, 'update'])->name('admin.updatePost');
        Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('admin.deletePost');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
