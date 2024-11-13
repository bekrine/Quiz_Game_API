<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/getQuestions',[QuestionController::class,'index']);
Route::get('/getAnswers/{id}',[AnswerController::class,'answers']);
Route::get('/checkAnswer/{id}',[AnswerController::class,'checkAnswer']);