<div>
    <div class="relative my-4 flex w-full max-w-xl flex-col gap-1 text-neutral-600">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
            stroke-width="2"
            class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        <input type="search"
            class="w-full rounded-xl bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
            name="search" aria-label="Search" placeholder="Procurar..." />
    </div>

    <div class="flex flex-col gap-2 overflow-y-auto scrollbar-thin pb-1">
        <div wire:poll.2s>
            @foreach ($chats as $item)
                <a href="{{ route('chat', $item->chat->id) }}"
                    class="flex items-center rounded-none gap-2 ps-1 py-2">
                    <img class="size-8 rounded-full object-cover"
                        src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
                    <div>
                        <p class="text-gray-600 text-md font-medium">{{ $item->chat->users[0]->user->name }}</p>
                        <p class="text-gray-700 text-sm">{{ $item->chat->last_message }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('newMessage', (event) => {
           //console.log('nova mensagem', event);
       });
    });
</script>