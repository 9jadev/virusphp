<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PeriodController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'admin'], function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/getdata', [AuthController::class, 'getData'])->middleware(['auth:sanctum']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
    // Route::get('connect', 'QuoteController@create')->name('create');
});


Route::group(['prefix'=>'courses'], function(){
    Route::post('/create', [CourseController::class, 'createcourses'])->middleware(['auth:sanctum']);
    Route::post('/edit', [CourseController::class, 'editcourse'])->middleware(['auth:sanctum']);
    Route::post('/single', [CourseController::class, 'single'])->middleware(['auth:sanctum']);
    Route::post('/delete', [CourseController::class, 'remove_delete'])->middleware(['auth:sanctum']);
    Route::post('/all', [CourseController::class, 'all'])->middleware(['auth:sanctum']);
});

Route::group(['prefix'=>'period'], function(){
    Route::post('/create', [PeriodController::class, 'createperiod'])->middleware(['auth:sanctum']);
});