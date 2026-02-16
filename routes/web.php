<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ContactController::class, 'dashboard']);

    //CREATE
    Route::get('/contact/create', [ContactController::class, 'create']);
    Route::post('/contacts', [ContactController::class, 'store']);

    //EDIT
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);

    Route::get('/contacts', [ContactController::class, 'list']);

    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
});