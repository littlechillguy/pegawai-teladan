<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\CriterionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AssessmentResultController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\AssessmentController;
use App\Http\Controllers\Admin\HallOfFameController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/assessment/{candidate}', [AssessmentController::class, 'create'])
        ->name('assessment.create');

    Route::post('/assessment/{candidate}', [AssessmentController::class, 'store'])
        ->name('assessment.store');

    Route::get('/change-password', [PasswordController::class, 'edit'])
        ->name('password.edit');

    Route::put('/change-password', [PasswordController::class, 'update'])
        ->name('password.update');

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // =========================
        // DASHBOARD
        // =========================
    
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // =========================
        // PEGAWAI
        // =========================
    
        Route::get('/employees', [EmployeeController::class, 'index'])
            ->name('employees.index');

        Route::get('/employees/create', [EmployeeController::class, 'create'])
            ->name('employees.create');

        Route::post('/employees', [EmployeeController::class, 'store'])
            ->name('employees.store');

        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('employees.edit');

        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
            ->name('employees.update');


        // Pilih pegawai sebagai kandidat periode aktif
        Route::post(
            '/employees/{employee}/select-candidate',
            [EmployeeController::class, 'selectCandidate']
        )->name('employees.select-candidate');

        // Batalkan pegawai sebagai kandidat
        Route::post(
            '/employees/{employee}/cancel-candidate',
            [EmployeeController::class, 'cancelCandidate']
        )->name('employees.cancel-candidate');

        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
            ->name('employees.destroy');


        // =========================
        // PERIODE
        // =========================
    
        Route::resource('periods', PeriodController::class)
            ->except(['show'])
            ->names('periods');

        Route::post('/periods/{period}/activate', [PeriodController::class, 'activate'])
            ->name('periods.activate');

        Route::get('/periods/{period}/winner', [PeriodController::class, 'winner'])
            ->name('periods.winner');


        // =========================
        // KANDIDAT
        // =========================
    
        Route::get('/candidates', [CandidateController::class, 'index'])
            ->name('candidates.index');

        Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])
            ->name('candidates.edit');

        Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])
            ->name('candidates.update');


        // =========================
        // KRITERIA
        // =========================
    
        Route::get('/criteria', [CriterionController::class, 'index'])
            ->name('criteria.index');

        Route::get(
            '/criteria/{criterion}/questions',
            [QuestionController::class, 'index']
        )->name('questions.index');

        Route::get(
            '/criteria/{criterion}/questions/create',
            [QuestionController::class, 'create']
        )->name('questions.create');

        Route::post(
            '/criteria/{criterion}/questions',
            [QuestionController::class, 'store']
        )->name('questions.store');

        Route::get(
            '/questions/{question}/edit',
            [QuestionController::class, 'edit']
        )->name('questions.edit');

        Route::put(
            '/questions/{question}',
            [QuestionController::class, 'update']
        )->name('questions.update');

        Route::put('/criteria', [CriterionController::class, 'update'])
            ->name('criteria.update');


        // =========================
        // HASIL PENILAIAN
        // =========================
    
        Route::get(
            '/assessment-results',
            [AssessmentResultController::class, 'index']
        )->name('assessment-results.index');

        Route::get(
            '/assessment-results/{candidate}',
            [AssessmentResultController::class, 'show']
        )->name('assessment-results.show');

        Route::post(
            '/assessment-results/{period}/complete',
            [AssessmentResultController::class, 'complete']
        )->name('assessment-results.complete');


        // =========================
        // HALL OF FAME
        // =========================
    
        Route::get(
            '/hall-of-fame',
            [HallOfFameController::class, 'index']
        )->name('hall-of-fame.index');
    });

require __DIR__ . '/auth.php';