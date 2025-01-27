<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function __invoke(Request $request, string $chat): View
    {
        $userAuth   = $request->user();
        $chat       = Chat::where('_id', $chat)
            ->with(['users' => function ($query) use ($userAuth) {
                $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            }])
            ->first();

        return view('message', ['chat' => $chat]);
    }
}
