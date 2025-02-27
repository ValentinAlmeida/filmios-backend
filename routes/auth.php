<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::post('/autenticar', [AutenticacaoController::class, 'autenticar']);
