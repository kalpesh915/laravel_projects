<?php

use App\Http\Controllers\studentsController;
use App\Http\Controllers\usersAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/


Route::post("/signup", [usersAuthController::class, "signUp"]);
Route::post("/login", [usersAuthController::class, "login"]);
Route::post("/logout", [usersAuthController::class, "logOut"])->middleware('auth:sanctum');

Route::apiResource("/students", studentsController::class)->middleware("auth:sanctum");
