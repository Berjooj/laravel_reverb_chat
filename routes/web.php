<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/chat', function () {
        return Inertia::render('Chat');
    })->name('chat');
});

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/chat/rooms', [ChatController::class, 'rooms']);
        Route::get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
        Route::post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);
    });