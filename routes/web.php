<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// voice routes
Route::get('voices', [VoiceController::class, 'index']);
Route::post('voices/vote/{question}', [VoiceController::class, 'voice'])->name('voices');

// other routes
Route::get('/questions', [QuestionController::class, 'question'])->name('questions');
Route::post('/question/vote/{question}', [QuestionController::class, 'vote'])->name('questions.vote');