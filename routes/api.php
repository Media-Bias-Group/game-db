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

//User endpoints
Route::post('/createUser', [ApiController::class, 'createUser']);
Route::post('/getXPValue', [ApiController::class, 'getXPValue']);
Route::post('/updateXPValue', [ApiController::class, 'updateXPValue']);
Route::post('/calculateGlobalSkill', [ApiController::class, 'calculateGlobalSkill']);

//Topics endpoints
Route::get('/getTopics', [ApiController::class, 'getTopics']);

//dailytopics endpoints
Route::post('/getDailyTopics', [ApiController::class, 'getTopicsDailyProgress']);

//sentences get
Route::post('/getSentencePackage', [ApiController::class, 'getSentencePackage']);
Route::post('/getWordSentences', [ApiController::class, 'getWordSentences']);

//answers endpoints
Route::post('/submitSentenceAnswer', [ApiController::class, 'submitSentenceAnswer']);
Route::post('/submitWordAnswer', [ApiController::class, 'submitWordAnswer']);
Route::post('/submitTutorialWordAnswer', [ApiController::class, 'submitTutorialWordAnswer']);

//progress get
Route::post('/getTopicDailyProgress', [ApiController::class, 'getTopicDailyProgress']);
// Route::post('/getTopicProgress', [ApiController::class, 'getTopicProgress']);
//progress post
Route::post('/submitSentenceProgress', [ApiController::class, 'submitSentenceProgress']);
Route::post('/submitTopicDailyProgress', [ApiController::class, 'submitTopicDailyProgress']);
Route::post('/submitTopicProgress', [ApiController::class, 'submitTopicProgress']);


//words endpoints
Route::post('/insertWrongAnswer', [ApiController::class, 'insertWrongAnswer']);

//tutorial endpoints
Route::post('/submitTutorial', [ApiController::class, 'submitTutorial']);
Route::get('/getLevel6', [ApiController::class, 'getLevel6']);
Route::get('/getLevel7', [ApiController::class, 'getLevel7']);
Route::post('/getWords', [ApiController::class, 'getWords']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
