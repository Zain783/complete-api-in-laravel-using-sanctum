<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Student;
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
//public routes
// Route::get("/students",[StudentController::class,'index']);

// Route::get("/students/{id}",[StudentController::class,'show']);
// Route::post("/students/store",[StudentController::class,'store']);
// Route::put("/students/{id}",[StudentController::class,'update']);
// Route::delete("/students/{id}",[StudentController::class,'destroy']);
// Route::get("/students/search/{city}",[StudentController::class,'search']);


// public routes
Route::post("/students/register",[UserController::class,'register']);
Route::post("/students/login",[UserController::class,'login']);
//private routes

Route::middleware('auth:sanctum')->get('/students', [StudentController::class,'index']);
Route::middleware('auth:sanctum')->get('/students/{id}', [StudentController::class,'show']);
Route::middleware('auth:sanctum')->post('/students/{id}', [StudentController::class,'store']);
Route::middleware('auth:sanctum')->put('/students/store', [StudentController::class,'update']);
Route::middleware('auth:sanctum')->delete('/students/{id}',[StudentController::class,'destroy'] );
Route::middleware('auth:sanctum')->get('/students/search/{city}',[StudentController::class,'search']);
Route::middleware('auth:sanctum')->post('/logout',[UserController::class,'logout']);
