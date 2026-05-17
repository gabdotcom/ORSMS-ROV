<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HR\JobPostingsController;
use App\Http\Controllers\HR\HRDashboardController;
use App\Http\Controllers\HR\ApplicationsController;
use App\Http\Controllers\Applicant\ApplicantController;

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
    // Applicant routes
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');
    Route::get('/applicant/jobs', [ApplicantController::class, 'jobs'])->name('applicant.jobs');
    Route::get('/applicant/jobs/{jobPosting}/apply', [ApplicantController::class, 'apply'])->name('applicant.apply');
    Route::get('/applicant/jobs/{jobPosting}/apply-form', [ApplicantController::class, 'getApplyForm'])->name('applicant.apply-form');
    Route::post('/applicant/applications', [ApplicantController::class, 'storeApplication'])->name('applicant.store-application');
    Route::post('/applicant/applications/{application}/withdraw', [ApplicantController::class, 'withdraw'])->name('applicant.withdraw');
    Route::get('/applicant/applications/{application}', [ApplicantController::class, 'viewApplication'])->name('applicant.view-application');
    Route::get('/applicant/applications/{application}/edit', [ApplicantController::class, 'editApplication'])->name('applicant.edit-application');
    Route::put('/applicant/applications/{application}', [ApplicantController::class, 'updateApplication'])->name('applicant.update-application');
    Route::delete('/applicant/applications/{application}/entry', [ApplicantController::class, 'deleteEntry'])->name('applicant.delete-entry');
    Route::get('/applicant/profile', [ApplicantController::class, 'profile'])->name('applicant.profile');
    Route::post('/applicant/profile', [ApplicantController::class, 'updateProfile'])->name('applicant.update-profile');

    Route::get('/hr/dashboard', [HRDashboardController::class, 'index'])->name('hr.dashboard');

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

    // HR Job Postings (protected by auth middleware above)
    Route::get('/hr/job-postings', [JobPostingsController::class, 'index'])->name('hr.job-postings');
    Route::post('/hr/job-postings', [JobPostingsController::class, 'store']);
    Route::put('/hr/job-postings/{jobPosting}', [JobPostingsController::class, 'update']);
    Route::delete('/hr/job-postings/{jobPosting}', [JobPostingsController::class, 'destroy']);
    Route::get('/hr/job-postings/departments', [JobPostingsController::class, 'getDepartments'])->name('hr.job-postings.departments');
    Route::get('/hr/job-postings/positions', [JobPostingsController::class, 'getPositions'])->name('hr.job-postings.positions');
    Route::get('/hr/job-postings/position-details', [JobPostingsController::class, 'getPositionDetails'])->name('hr.job-postings.position-details');
    Route::get('/hr/job-postings/document-types', [JobPostingsController::class, 'getDocumentTypes'])->name('hr.job-postings.document-types');

    // HR Applications
    Route::get('/hr/applications', [ApplicationsController::class, 'index'])->name('hr.applications');
    Route::get('/hr/applications/{application}', [ApplicationsController::class, 'show'])->name('hr.applications.show');
    Route::put('/hr/applications/{application}/status', [ApplicationsController::class, 'updateStatus'])->name('hr.applications.update-status');
    Route::put('/hr/applications/{application}/sector-evaluation', [ApplicationsController::class, 'storeSectorEvaluation'])->name('hr.applications.sector-evaluation');
    Route::get('/hr/applications/{application}/details', [ApplicationsController::class, 'getApplicationDetails'])->name('hr.applications.details');
});
