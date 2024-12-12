<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message-channel', function ($user, $id) {
    return true;
});

Broadcast::channel('chat-channel.{chat_id}', function (User $user, string $chat_id) {
    $chat           = Chat::find($chat_id);
    $participants   = $chat->participants;
    $is_participant = false;

    foreach ($participants as $participant) {
        if ($participant['id'] === $user->id) $is_participant = true;
    }

    return $is_participant;
});


