<?php

namespace App\Livewire\List;

use Livewire\Attributes\On;
use Livewire\Component;

class Conversation extends Component
{
    /**
     * @var null|MongoDB\Collection
     */
    public $chats = null;

    #[On('newMessage')]
    public function newMessage()
    {
        dd('teste');
    }

    public function render()
    {
        return view('livewire.list.conversation');
    }
}
