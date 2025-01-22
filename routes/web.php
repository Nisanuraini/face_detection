<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\FaceDetectionController;
use App\Http\Controllers\FaceDetectionListController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassModelController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PickupStudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('admin/user', [UserController::class, 'index']);
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('admin/pickups', [PickupController::class, 'index'])->name('pickups');

Route::resource('admin/classes', ClassModelController::class)->names('classes');
Route::resource('admin/students', StudentController::class)->names('students');
Route::resource('admin/schools', SchoolController::class)->names('schools');
Route::resource('admin/pickups', PickupController::class)->names('pickups');
Route::resource('admin/pickupstudents', PickupStudentController::class)->names('pickupstudents');

Route::get('/face-detection', [FaceDetectionController::class, 'index']);

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
