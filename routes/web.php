<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', fn () => view('home') );

Route::get('/chat/{chat}', function (Chat $chat) {
    Auth::loginUsingId(1);
    return view('message', ['chat' => $chat]);
})->name('chat');

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
