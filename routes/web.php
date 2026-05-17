<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect old dashboard URL to role-based dashboard
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return match(auth()->user()->role) {
        'hr' => redirect('/hr/dashboard'),
        'board' => redirect('/board/dashboard'),
        'admin' => redirect('/admin/dashboard'),
        default => redirect('/applicant/dashboard'),
    };
})->name('dashboard');

// Protected routes - require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/applicant/dashboard', function () {
        if (auth()->user()->role !== 'applicant') {
            return redirect('/' . auth()->user()->role . '/dashboard');
        }
        return view('applicant.dashboard');
    })->name('applicant.dashboard');

    Route::get('/hr/dashboard', function () {
        if (auth()->user()->role !== 'hr') {
            return redirect('/' . auth()->user()->role . '/dashboard');
        }
        return view('hr.dashboard');
    })->name('hr.dashboard');

    Route::get('/board/dashboard', function () {
        if (auth()->user()->role !== 'board') {
            return redirect('/' . auth()->user()->role . '/dashboard');
        }
        return view('board.dashboard');
    })->name('board.dashboard');

    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/' . auth()->user()->role . '/dashboard');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
