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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'jests'])->name('morphy.jests');
Route::get('/words', [App\Http\Controllers\HomeController::class, 'words'])->name('morphy.words');
Route::get('/statistics', [App\Http\Controllers\HomeController::class, 'statistics'])->name('morphy.statistics');
Route::get('/intersections', [App\Http\Controllers\HomeController::class, 'intersections'])->name('morphy.intersections.wordforms');
