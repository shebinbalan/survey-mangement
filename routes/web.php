<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\User\UserSurveyController;
use App\Http\Controllers\User\UserResponseController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResponseExportController;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  // Response Management
    Route::get('/responses', [ResponseExportController::class, 'index'])->name('responses.index');
    Route::get('/responses/export/excel', [ResponseExportController::class, 'exportExcel'])->name('responses.export.excel');
    Route::get('/responses/{id}/export/pdf', [ResponseExportController::class, 'exportPdf'])->name('responses.export.pdf');

    Route::resource('surveys', SurveyController::class);
    Route::get('/surveys/{id}/preview', [SurveyController::class, 'preview'])->name('surveys.preview');
    
    Route::get('/surveys/{id}/reorder', function ($id) {
        $survey = \App\Models\Survey::with('questions')->findOrFail($id);
        return view('admin.surveys.reorder', compact('survey'));
    })->name('surveys.reorderPage');

    Route::post('/surveys/{id}/reorder', [SurveyController::class, 'reorderQuestions'])->name('surveys.reorderQuestions');

    // ✅ FIXED RESPONSE ROUTE
    Route::get('/surveys/{id}/responses', [SurveyController::class, 'showResponses'])->name('surveys.responses');

    Route::resource('questions', QuestionController::class);
    Route::resource('options', OptionController::class);
    Route::resource('users', UserController::class);
    Route::post('/questions/{questionId}/reorder-options', [OptionController::class, 'reorderOptions'])->name('options.reorderOptions');

  
});


Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserSurveyController::class, 'dashboard'])->name('dashboard');
    Route::get('/surveys', [UserSurveyController::class, 'index'])->name('surveys.index');
    Route::get('/surveys/{id}/question/{index}', [UserSurveyController::class, 'showQuestion'])->name('surveys.question');

    // ✅ Add this POST route
    Route::post('/surveys/{survey_id}/question/{question_id}', [UserSurveyController::class, 'submitAnswer'])->name('surveys.answer');

    Route::get('/surveys/thankyou', function () {
        return view('user.surveys.thankyou');
    })->name('surveys.thankyou');

     Route::get('/responses', [UserResponseController::class, 'responses'])->name('responses.index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


