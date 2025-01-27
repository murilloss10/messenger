<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function __construct(
        protected Chat $chat,
        protected UserChat $userChat
    ) {}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, User $user): RedirectResponse
    {
        $userAuth   = $request->user();
        $chat       = $this->chat->where([
                ['participants.id', $userAuth->id],
                ['participants.id', $user->id]
            ])
            ->first();


        if (!$chat) {
            $chat = $this->chat->create([
                'participants' => [
                    [
                        'id'    => $userAuth->id,
                        'name'  => $userAuth->name,
                    ],
                    [
                        'id'    => $user->id,
                        'name'  => $user->name
                    ]
                ],
                'last_message' => '',
            ]);

            $this->userChat->create([
                'user_id' => $user->id,
                'chat_id' => $chat->_id,
            ]);

            $this->userChat->create([
                'user_id' => $userAuth->id,
                'chat_id' => $chat->_id,
            ]);
        }

        return redirect()->route('chat', ['chat' => $chat->_id]);
    }
}
