<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return 'Home';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ----- Kiosks
Route::get('/kiosks/surveys', [\App\Http\Controllers\KioskController::class, "surveyKiosk"]);


// ----- Survey Questions
Route::resource('survey-questions', \App\Http\Controllers\SurveyQuestionController::class);

// Include the auth routes
require __DIR__.'/auth.php';
