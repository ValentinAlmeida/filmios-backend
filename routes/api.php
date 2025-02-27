<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\ServiceController;
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

Route::get('/service/{uuid}', [ServiceController::class, 'findByUuid']);

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

    Route::prefix('/responsible')->group(function () {
        Route::get('/', [ResponsibleController::class, 'search'])->middleware('feature.permission');
        Route::post('/', [ResponsibleController::class, 'create']);
        Route::prefix('/{id}')->group(function () {
            Route::get('/', [ResponsibleController::class, 'findById'])->middleware('feature.permission');
            Route::put('/', [ResponsibleController::class, 'update'])->middleware('feature.permission');
            Route::put('/active', [ResponsibleController::class, 'active'])->middleware('feature.permission');
        });
    });

    Route::prefix('/request')->group(function () {
        Route::get('/history/{id}', [RequestController::class, 'searchHistory'])->middleware('feature.permission');
        Route::get('/', [RequestController::class, 'searchByUserCreatorId']);
        Route::prefix('/{id}')->group(function () {
            Route::get('/', [RequestController::class, 'findById'])->middleware('feature.permission');
            Route::put('/', [RequestController::class, 'update'])->middleware('feature.permission');
        });
    });

    Route::prefix('/service')->group(function () {
        Route::get('/dispensa/{id}', [ServiceController::class, 'searchDispensa']);
        Route::post('/', [ServiceController::class, 'create']);
        Route::get('/', [ServiceController::class, 'search']);
    });

    Route::prefix('/activity')->group(function () {
        Route::get('/', [ActivityController::class, 'search']);
    });

    Route::prefix('/establishment')->group(function () {
        Route::get('/', [EstablishmentController::class, 'search'])->middleware('feature.permission');
        Route::post('/', [EstablishmentController::class, 'create']);
        Route::get('/noUser', [EstablishmentController::class, 'searchByUserCreatorId']);
        Route::prefix('/{id}')->group(function () {
            Route::get('/', [EstablishmentController::class, 'findById'])->middleware('feature.permission');
            Route::put('/', [EstablishmentController::class, 'update'])->middleware('feature.permission');
            Route::put('/active', [EstablishmentController::class, 'active'])->middleware('feature.permission');
        });
    });

    Route::prefix('/archive')->group(function () {
        Route::put('/responsible/{id}', [ArchiveController::class, 'createResponsible']);
        Route::put('/establishment/{id}', [ArchiveController::class, 'createEstablishment']);
    });

    Route::prefix('/domain')->group(function () {
        Route::get('/localities', [DomainController::class, 'searchLocalities']);
        Route::get('/cnae', [DomainController::class, 'searchCnae']);
        Route::get('/statusEstablishment', [DomainController::class, 'searchStatusEstablishment']);
        Route::get('/openingHours', [DomainController::class, 'searchOpeningHours']);
        Route::get('/type-service', [DomainController::class, 'searchTypeServices']);
        Route::get('/document', [DomainController::class, 'searchDocument']);
        Route::get('/establishment/noUser', [DomainController::class, 'searchEstablishment']);
    });

    Route::prefix('/permission')->group(function () {
        Route::put('/sync', [PermissionController::class, 'sync']);
        Route::get('/features', [PermissionController::class, 'searchFeatures']);
        Route::get('/profiles', [PermissionController::class, 'searchProfiles']);
    });
});
