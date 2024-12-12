<?php

namespace App\Livewire\Message;

use App\Events\SendMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\View\View;
use Livewire\Component;

class Send extends Component
{
    /**
     * @var \App\Models\Chat|null
     */
    public $chat = null;

    /**
     * @var \App\Models\User|null
     */
    public $authenticatedUser = null;

    /**
     * @var string
     */
    public $contentOfNewMessage = '';

    /**
     * @var \MongoDB\Collection|mixed|null
     */
    public $allMessages = null;

    /**
     * @param \App\Models\Chat $chat
     * @return void
     */
    public function mount(Chat $chat): void
    {
        $chat->load('messages');

        $this->allMessages          = $chat->messages;
        $this->authenticatedUser    = auth()->user();
    }

    /**
     * @return array
     */
    public function getListeners(): array
    {
        return [
            "echo-private:chat-channel.{$this->chat->id},SendMessage" => 'allMessages',
        ];
    }

    /**
     * Recebe array com dados recebidos pelo evento e à acrescenta ao array/collection;
     * 
     * @param array $event
     * @return void
     */
    public function allMessages(array $event): void
    {
        $newMessage         = new Message($event['message']);
        $newMessage->_id    = $event['message']['_id'];

        $this->allMessages->push($newMessage);
    }

    /**
     * Salva mensagem e a dispara para evento.
     * 
     * @return void
     */
    public function sendNewMessage(): void
    {
        $messageCreated = Message::create([
            'chat_id'       => $this->chat->id,
            'sender'        => $this->authenticatedUser->toArray(),
            'content'       => $this->contentOfNewMessage,
            'viewed_by'     => [],
            'received_by'   => [],
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        SendMessage::dispatch($this->chat, $messageCreated);

        $this->contentOfNewMessage = '';
    }

    /**
     * Renderiza view.
     * 
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('livewire.message.send');
    }
}
