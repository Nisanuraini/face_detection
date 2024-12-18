<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\FaceDetectionController;
use App\Http\Controllers\FaceDetectionListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route Default
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('admin/home/students', StudentController::class);

Route::get('admin/user', [UserController::class, 'index']);
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/pickups', [PickupController::class, 'index'])->name('pickups');

Route::middleware(['auth'])->group(function () {
    Route::get('/face-detection', [FaceDetectionController::class, 'index'])->name('face-detection');
    Route::get('/face-detection-list', [FaceDetectionListController::class, 'index'])->name('face-detection-list');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
});
Route::get('/search', [PickupController::class, 'search'])->name('search.pickups');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
