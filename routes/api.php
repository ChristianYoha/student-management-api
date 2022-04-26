<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SemesterController;
use App\Http\Middleware\ApiToken;
use App\Models\Course;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {

    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/logout', [AuthController::class],'logout');

});

Route::middleware('jwt.auth')->group(function () {

    Route::get('/promotions', [PromotionController::class, 'index']);
    Route::get('/promotion/{promotion}', [PromotionController::class, 'show']);
    Route::post('/promotion', [PromotionController::class, 'store']);
    Route::put('/promotion/{promotion}', [PromotionController::class, 'update']);

    // -----------------------------------------------------------------------
    // Route::get('/semesters', [SemesterController::class, 'index']);
    // Route::get('/semester/{semester}', [SemesterController::class, 'show']);
    // Route::post('/semester', [SemesterController::class, 'store']);
    // Route::put('/semester/{semester}', [SemesterController::class, 'update']);
    // -----------------------------------------------------------------------

    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/student/{student}', [StudentController::class, 'show']);
    Route::get('/students/create', [StudentController::class, 'create']);
    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student/{student}/edit', [StudentController::class, 'edit']);
    Route::put('/student/{student}', [StudentController::class, 'update']);
    Route::delete('/student/{student}', [StudentController::class, 'destroy']);

    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teacher/{teacher}', [TeacherController::class, 'show']);
    Route::post('/teacher', [TeacherController::class, 'store']);
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit']);
    Route::put('/teacher/{teacher}', [TeacherController::class, 'update']);
    Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy']);

    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/course/{course}', [CourseController::class, 'show']);
    Route::get('/courses/create', [CourseController::class, 'create']);
    Route::post('/course', [CourseController::class, 'store']);
    Route::get('/course/{course}/edit', [CourseController::class, 'edit']);
    Route::put('/course/{course}', [CourseController::class, 'update']);

    Route::get('/rate/{student}', [RateController::class, 'getRate']);
    Route::get('/new_rate/{student}/create', [RateController::class, 'create']);
    Route::post('/new_rate', [RateController::class, 'store']);

});

