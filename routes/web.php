<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/',[DocumentController::class,'index']);
Route::post('/save-document',[DocumentController::class,'store']);

Route::get('/categories',[DocumentController::class,'categories']);
Route::get('/items/{category}',[DocumentController::class,'items']);
