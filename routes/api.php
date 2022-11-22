<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TeamPersonController;
use App\Http\Controllers\API\MatchScheduleController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class,'login']);
    // Route::resource('teams',TeamController::class);
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('teams')->group(function () {
        Route::get('/', [TeamController::class,'show']);
        Route::post('create', [TeamController::class,'store']);
        Route::post('update/{id}', [TeamController::class,'update']);
        Route::post('delete/{id}', [TeamController::class,'destroy']);
        Route::prefix('person')->group(function () {
            Route::get('/', [TeamPersonController::class,'show']);
            Route::post('create', [TeamPersonController::class,'store']);
            Route::post('update/{id}', [TeamPersonController::class,'update']);
            Route::post('delete/{id}', [TeamPersonController::class,'destroy']);
        });
    });
    Route::prefix('match')->group(function () {
        Route::get('/', [MatchScheduleController::class,'show']);
        Route::post('create', [MatchScheduleController::class,'store']);
        Route::post('update/{id}', [MatchScheduleController::class,'update']);
        Route::post('delete/{id}', [MatchScheduleController::class,'update']);
        Route::prefix('log')->group(function () {
            Route::get('/{match}', [MatchScheduleController::class,'viewLogMatch']);
            Route::post('create', [MatchScheduleController::class,'storeLogMatch']);
            Route::post('delete/id', [MatchScheduleController::class,'removeLogMatch']);
        });
    });
});

