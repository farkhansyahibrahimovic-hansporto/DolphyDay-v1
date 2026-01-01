<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MicroActionController;
use App\Http\Controllers\User\GrowthLogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;

/*
|--------------------------------------------------------------------------
| Guest Routes (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => view('welcome'))->name('home');

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| User Routes (role = user)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('user.profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('user.profile.update');

    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])
        ->name('user.profile.avatar');

    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])
        ->name('user.profile.avatar.delete');

    Route::prefix('micro-actions')->name('micro-actions.')->group(function () {
        Route::get('/', [MicroActionController::class, 'index'])->name('index');
        Route::get('/create', [MicroActionController::class, 'create'])->name('create');
        Route::post('/', [MicroActionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MicroActionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MicroActionController::class, 'update'])->name('update');
        Route::post('/{id}/complete', [MicroActionController::class, 'complete'])->name('complete');
        Route::delete('/{id}', [MicroActionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('growth')->name('growth.')->group(function () {
        Route::get('/', [GrowthLogController::class, 'index'])->name('index');
        Route::get('/create', [GrowthLogController::class, 'create'])->name('create');
        Route::post('/', [GrowthLogController::class, 'store'])->name('store');
        Route::get('/{id}', [GrowthLogController::class, 'show'])->name('show');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (role = admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Users Management Routes
        Route::get('/users', [UserManagementController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserManagementController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserManagementController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{id}', [UserManagementController::class, 'show'])
            ->name('users.show');

        Route::get('/users/{id}/activity', [UserManagementController::class, 'activityLog'])
            ->name('users.activity');

        // Edit & Update Routes
        Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{id}', [UserManagementController::class, 'update'])
            ->name('users.update');

        Route::put('/users/{id}/password', [UserManagementController::class, 'updatePassword'])
            ->name('users.update-password');

        // Delete Route
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])
            ->name('users.destroy');
    });