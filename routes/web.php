<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('/login',[LoginController::class,'login']);

Route::group(['middleware' => [IsAuthenticate::class]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});