<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/archive/{relativo}', [ArchiveController::class, 'download'])
    ->where('relativo', '^([A-z0-9-]+\/?)+\.[a-z0-9]+$');
