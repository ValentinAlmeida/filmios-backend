<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/authenticate')->group(function () {
    Route::post('/refreshToken', [AuthenticationController::class, 'refreshToken'])->middleware('refresh.token');
    Route::post('/', [AuthenticationController::class, 'authenticate']);
});

Route::get('/version', function () {
    return response()->json(['version' => json_decode(File::get(base_path('composer.json')), true)['version'] ?? 'Versão não encontrada']);
});

Route::post('/recover-password', [AuthenticationController::class, 'recoverPassword']);
Route::put('/reset-password', [AuthenticationController::class, 'resetPassword'])->middleware('recovery.user');

Route::prefix('/users')->group(function(){
    Route::post('/noProfile', [UserController::class, 'createNoProfile']);
    Route::get('/logged', [UserController::class, 'searchUserLogged'])->middleware('auth');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/users')->middleware('feature.permission')->group(function () {
        Route::get('/', [UserController::class, 'search']);
        Route::post('/', [UserController::class, 'create']);
        Route::prefix('/{id}')->group(function () {
            Route::delete('/', [UserController::class, 'delete']);
            Route::get('/', [UserController::class, 'findById']);
            Route::put('/modify-state', [UserController::class, 'modifyState']);
            Route::put('/', [UserController::class, 'update']);
            Route::put('/unblock', [AuthenticationController::class, 'unblockAccess']);
        });
    });
});
