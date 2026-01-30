<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [PasswordController::class, 'forgotPassword']);
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.reset');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/email/verification-notification', [VerificationController::class, 'sendNotification']);
    Route::get('auth/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify');

    Route::get('user/me', [UserController::class, 'me']);
    Route::delete('user/delete', [UserController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::patch('user/update', [UserController::class, 'update']);
    Route::patch('user/password/update', [PasswordController::class, 'update']);

    Route::get('users/search', [UserController::class, 'search']);
    Route::get('users/{user}/status', [UserController::class, 'status']);
    Route::get('groups/search', [ConversationController::class, 'searchPublicGroups']);

    Route::prefix('conversations')->group(function () {
        Route::get('/', [ConversationController::class, 'index']);
        Route::post('/', [ConversationController::class, 'store']);
        Route::get('/show', [ConversationController::class, 'show']);
        Route::delete('/delete', [ConversationController::class, 'destroy']);
        Route::post('/add-participant', [ConversationController::class, 'addParticipant']);
        Route::post('/remove-participant', [ConversationController::class, 'removeParticipant']);
        Route::post('/leave', [ConversationController::class, 'leave']);
        Route::get('{conversation}/messages', [MessageController::class, 'index']);
    });

    Route::prefix('messages')->group(function () {
        Route::post('/', [MessageController::class, 'store']);
        Route::patch('{message}/read', [MessageController::class, 'markAsRead']);
        Route::delete('{message}', [MessageController::class, 'destroy']);
    });
});
