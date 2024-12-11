<?php

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home') );
Route::get('/message', fn () => view('message'));
Route::get('/chat/{chat}', fn (Chat $chat) => view('home', ['chat' => $chat]) );