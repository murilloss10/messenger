<?php

namespace App\Livewire\Message;

use App\Events\SendMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Send extends Component
{
    public $chat = null;

    public $user = null;

    public $content = '';

    public $messages = null;

    public function mount(Chat $chat): void
    {
        $chat->load('messages');

        $this->messages = $chat->messages;
        $this->user     = [
            'id' => 1,
            'name' => 'Administrador'
        ];
    }

    #[On('echo:chat-channel.{chat.id},SendMessage')]
    public function allMessages($event): void
    {
        $this->messages->push(new Message($event['message']));
    }

    public function sendNewMessage(): void
    {
        $message_created = Message::create([
            'chat_id'       => $this->chat->id,
            'sender'        => $this->user,
            'content'       => $this->content,
            'viewed_by'     => [],
            'received_by'   => [],
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        SendMessage::dispatch($this->chat, $message_created);

        $this->content = '';
    }

    public function render(): View
    {
        return view('livewire.message.send');
    }
}
