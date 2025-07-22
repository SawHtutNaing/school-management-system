<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentMarkController;


// Landing page
// Public landing page or redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('admin.pages.dashboard'))->name('dashboard');
});

// Login/Register routes
Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('admin.pages.auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Teacher
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('teachers', TeacherController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

use App\Http\Controllers\StudentController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('students', StudentController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});


//Subjects


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('subjects', SubjectController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/subjects/filter/{type}', [SubjectController::class, 'filterByType'])->name('subjects.filter'); // ✅ FIXED
});






Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Result Routes
    Route::get('/results', [StudentMarkController::class, 'index'])->name('results.index');
    Route::post('/results/store', [StudentMarkController::class, 'store'])->name('results.store');
    Route::get('/results/create', [StudentMarkController::class, 'create'])->name('results.create');
    Route::get('/results/{result}/edit', [StudentMarkController::class, 'edit'])->name('results.edit'); // ✅ correct edit route
    Route::put('/results/{result}', [StudentMarkController::class, 'update'])->name('results.update');
    Route::delete('/results/{result}', [StudentMarkController::class, 'destroy'])->name('results.destroy');
});


// routes/web.php

use App\Http\Controllers\DashboardController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



