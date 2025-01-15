<?php

namespace App\Livewire\List;

use App\Models\Chat;
use Livewire\Attributes\On;
use Livewire\Component;

class Conversation extends Component
{
    /**
     * @var null|MongoDB\Collection
     */
    public $chats = null;

    /**
     * @var string
     */
    public string $search = '';

    #[On('newMessage')]
    public function newMessage()
    {
        dd('teste');
    }

    public function updatedSearch(): void
    {
        $userAuth       = auth()->user();
        $this->chats    = Chat::where('participants.id', $userAuth->id)
            ->when(strlen($this->search) > 3, function ($query) {
                return $query->where('participants.name', 'like', '%' . $this->search . '%');
            })
            ->with(['users' => function ($query) use ($userAuth) {
                $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            }])
            ->get();
    }

    public function mount(): void
    {
        $userAuth       = auth()->user();
        $this->chats    = Chat::where('participants.id', $userAuth->id)
            ->with(['users' => function ($query) use ($userAuth) {
                $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            }])
            ->get();
    }

    public function render()
    {
        return view('livewire.list.conversation');
    }
}
