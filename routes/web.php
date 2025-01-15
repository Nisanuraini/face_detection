<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\FaceDetectionController;
use App\Http\Controllers\FaceDetectionListController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassModelController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('admin/user', [UserController::class, 'index']);
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('admin/pickups', [PickupController::class, 'index'])->name('pickups');

Route::get('admin/classes', [ClassModelController::class, 'index'])->name('classes.index');
Route::get('admin/classes/create', [ClassModelController::class, 'create'])->name('classes.create');
Route::post('admin/classes', [ClassModelController::class, 'store'])->name('classes.store');
Route::get('admin/classes/{classmodel}', [ClassModelController::class, 'show'])->name('classes.show');
Route::get('admin/classes/{classmodel}/edit', [ClassModelController::class, 'edit'])->name('classes.edit');
Route::put('admin/classes/{classmodel}', [ClassModelController::class, 'update'])->name('classes.update');
Route::delete('admin/classes/{classmodel}', [ClassModelController::class, 'destroy'])->name('classes.destroy');

Route::get('admin/students', [StudentController::class, 'index'])->name('students.index');
Route::get('admin/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('admin/students', [StudentController::class, 'store'])->name('students.store');
Route::get('admin/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::get('admin/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('admin/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('admin/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('admin/schools', [SchoolController::class, 'index'])->name('schools.index');
Route::get('admin/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('admin/schools', [SchoolController::class, 'store'])->name('schools.store');
Route::get('admin/schools/{school}', [SchoolController::class, 'show'])->name('schools.show');
Route::get('admin/schools/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
Route::put('admin/schools/{school}', [SchoolController::class, 'update'])->name('schools.update');
Route::delete('admin/schools/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');

Route::get('admin/pickups', [PickupController::class, 'index'])->name('pickups.index');
Route::get('admin/pickups/create', [PickupController::class, 'create'])->name('pickups.create');
Route::post('admin/pickups', [PickupController::class, 'store'])->name('pickups.store');
Route::get('admin/pickups/{pickup}', [PickupController::class, 'show'])->name('pickups.show');
Route::get('admin/pickups/{pickup}/edit', [PickupController::class, 'edit'])->name('pickups.edit');
Route::put('admin/pickups/{pickup}', [PickupController::class, 'update'])->name('pickups.update');
Route::delete('admin/pickups/{pickup}', [PickupController::class, 'destroy'])->name('pickups.destroy');

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
