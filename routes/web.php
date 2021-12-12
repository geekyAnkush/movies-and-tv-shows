<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[\App\Http\Controllers\MoviesController::class,'index']);
Route::get('/movies/{id}',[\App\Http\Controllers\MoviesController::class,'show']);

Route::get('/actors',[\App\Http\Controllers\ActorsController::class,'index']);
Route::get('/actors/page/{page?}',[\App\Http\Controllers\ActorsController::class,'index']);
Route::get('/actors/{id}',[\App\Http\Controllers\ActorsController::class,'show']);

Route::get('/tv',[\App\Http\Controllers\TvController::class,'index']);
Route::get('/tv/{id}',[\App\Http\Controllers\TvController::class,'show']);
