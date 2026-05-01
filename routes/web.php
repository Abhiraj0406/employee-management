<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Employee\EmployeeProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('employee.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Breeze Account Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/employees', [EmployeeController::class, 'index'])
            ->name('employees.index');

        Route::get('/employees/{employeeProfile}', [EmployeeController::class, 'show'])
            ->name('employees.show');
    });

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('dashboard');

        Route::get('/profile', [EmployeeProfileController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/create', [EmployeeProfileController::class, 'create'])
            ->name('profile.create');

        Route::post('/profile', [EmployeeProfileController::class, 'store'])
            ->name('profile.store');

        Route::get('/profile/edit', [EmployeeProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [EmployeeProfileController::class, 'update'])
            ->name('profile.update');
    });

require __DIR__ . '/auth.php';
