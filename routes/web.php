<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\CriterionController;
use App\Http\Controllers\Admin\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

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

        // PERIODE
        Route::resource('periods', PeriodController::class)
            ->except(['show', 'destroy'])
            ->names('periods');

        Route::get('/candidates', [CandidateController::class, 'index'])
            ->name('candidates.index');

        Route::get('/candidates/create', [CandidateController::class, 'create'])
            ->name('candidates.create');

        Route::post('/candidates', [CandidateController::class, 'store'])
            ->name('candidates.store');

        Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])
            ->name('candidates.edit');

        Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])
            ->name('candidates.update');

        Route::get('/criteria', [CriterionController::class, 'index'])
            ->name('criteria.index');

        Route::get('/criteria/{criterion}/questions', [QuestionController::class, 'index'])
            ->name('questions.index');

        Route::get('/criteria/{criterion}/questions/create', [QuestionController::class, 'create'])
            ->name('questions.create');

        Route::post('/criteria/{criterion}/questions', [QuestionController::class, 'store'])
            ->name('questions.store');

        Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])
            ->name('questions.edit');

        Route::put('/questions/{question}', [QuestionController::class, 'update'])
            ->name('questions.update');
    });

require __DIR__ . '/auth.php';