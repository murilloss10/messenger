<?php

namespace App\Livewire\List;

use App\Models\Chat;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Conversation extends Component
{
    /**
     * @var null|MongoDB\Collection
     */
    public $chats = null;

    /**
     * @var aray|\Illuminate\Database\Eloquent\Collection
     */
    public $users = [];

    /**
     * @var string
     */
    public string $search = '';

    #[On('newMessage')]
    public function newMessage()
    {
        dd('teste');
    }

    /**
     * @return void
     */
    public function updatedSearch(): void
    {
        $this->refreshChats();
    }

    /**
     * @return void
     */
    public function refreshChats(): void
    {
        $userAuth = auth()->user();

        $this->chats = Chat::where('participants.id', $userAuth->id)
            ->orderBY('updated_at', 'desc')
            ->when(strlen($this->search) > 3, function ($query) {
                return $query->where('participants.name', 'like', '%' . $this->search . '%');
            })
            ->with(['users' => function ($query) use ($userAuth) {
                $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            }])
            ->get();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $userAuth       = auth()->user();
        $this->users    = User::select('id', 'name')->where('id', '<>', $userAuth->id)->get();
        $this->chats    = Chat::where('participants.id', $userAuth->id)
            ->orderBY('updated_at', 'desc')
            ->with(['users' => function ($query) use ($userAuth) {
                $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            }])
            ->get();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('livewire.list.conversation');
    }

}
