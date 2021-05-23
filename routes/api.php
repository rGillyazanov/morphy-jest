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

Route::get('/words/{word}', [\App\Http\Controllers\TestController::class, 'show']);
Route::get('/allWords', [\App\Http\Controllers\TestController::class, 'allWords']);
Route::get('/jestsOfWord/{wordId}', [\App\Http\Controllers\TestController::class, 'jestsOfWord']);
Route::get('/allWordsOfJest/{jestId}', [\App\Http\Controllers\TestController::class, 'allWordsOfJest']);
Route::get('/getWordFormsInJest/{jestId}', [\App\Http\Controllers\TestController::class, 'getWordFormsInJest']);
Route::post('/storeWordFormsInJest', [\App\Http\Controllers\TestController::class, 'storeWordFormsInJest']);
