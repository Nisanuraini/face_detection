<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\FaceDetectionController;
use App\Http\Controllers\ListFaceDetectionController;
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
Route::get('/admin', [DashboardController::class, 'index']);
Route::get('admin/pickups', [PickupController::class, 'index'])->name('pickups');

Route::resource('admin/classes', ClassModelController::class);
Route::resource('admin/students', StudentController::class);
Route::resource('admin/schools', SchoolController::class);
Route::resource('admin/pickups', PickupController::class);
Route::resource('admin/face-detection', FaceDetectionController::class);
Route::resource('admin/listfacedetections', ListFaceDetectionController::class);

Route::get('/face-detection/data', [FaceDetectionController::class, 'getData'])->name('face-detection-data');

Route::middleware(['auth'])->group(function () {
    Route::get('/face-detection', [FaceDetectionController::class, 'index'])->name('face-detection');
    Route::post('/face-detection/submit', [FaceDetectionController::class, 'submit'])->name('face-detection-submit');
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