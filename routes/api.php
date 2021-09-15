<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
// generic methods
Route::put('/create', [ApiController::class, 'create']);
Route::put('/createWithColumns', [ApiController::class, 'createWithColumns']);
Route::put('/updateOrInsert', [ApiController::class, 'updateOrInsert']);
Route::put('/updateValue', [ApiController::class, 'updateValue']);
Route::post('/singleSelect', [ApiController::class, 'singleSelect']);
Route::post('/increment', [ApiController::class, 'increment']);


Route::get('/randomQuestions', [ApiController::class, 'randomQuestions']);
Route::get('/dailyTopics', [ApiController::class, 'getDailyTopics']);
Route::post('/calculateBias', [ApiController::class, 'calculateBias']);

//survey endpoints
Route::post('/submitSurvey', [ApiController::class, 'submitSurvey']);
//tutorial endpoints
Route::post('/submitTutorial', [ApiController::class, 'submitTutorial']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
