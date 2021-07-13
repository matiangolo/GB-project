<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Note: all API routes are prefixed with 'api/'

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//--- Survery Kiosk endpoints
Route::get('survey-questions/question-of-the-day', [\App\Http\Controllers\SurveyQuestionApiController::class, "questionOfTheDay"] ); // -> http://localhost:8000/api/survey-questions/question-of-the-day
Route::post('survey-questions/question-of-the-day/{id}', [\App\Http\Controllers\SurveyQuestionApiController::class, "answerQuestionOfTheDay"] );

Route::post('feedback', [\App\Http\Controllers\SurveyQuestionApiController::class, "registerFeedbackForm"]);
