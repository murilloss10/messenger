<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home') );
Route::get('/message', fn () => view('message'));
Route::get('/chat/{chat}', function (Chat $chat) {
    Auth::loginUsingId(1);
    return view('home', ['chat' => $chat]);
})->name('chat');