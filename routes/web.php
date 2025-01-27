<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConversationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('home', fn () => view('home') )->name('home');
    Route::get('chat/{chat}', ChatController::class)->name('chat');
    Route::get('user/{user}/conversation', ConversationController::class)->name('conversation');
});