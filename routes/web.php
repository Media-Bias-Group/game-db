<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\AutomaticController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/manual', function () {
    return view('manual');
})->middleware(['auth'])->name('dashboard');


Route::get('/automatic', function () {
    return view('automatic');
})->middleware(['auth'])->name('dashboard');

Route::post('manual', [ManualController::class, 'store'])->middleware(['auth'])->name('dashboard');
Route::post('automatic', [AutomaticController::class, 'import'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
