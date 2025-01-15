<div>
    <div class="flex items-center mt-4">
        <div class="relative flex w-full max-w-xl flex-col gap-1 text-neutral-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                stroke-width="2"
                class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="search" name="search" wire:model.live="search"
                class="w-full rounded-xl bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
                aria-label="Search" placeholder="Procurar..." />
        </div>
    </div>

    <div class="flex flex-col gap-2 overflow-y-auto scrollbar-thin pb-1">
        <div wire:poll.2s>
            @if ($chats)
                @foreach ($chats as $item)
                    <a href="{{ route('chat', $item->id) }}"
                        class="flex items-center rounded-none gap-2 ps-1 py-2">
                        <img class="size-8 rounded-full object-cover"
                            src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
                        <div>
                            <p class="text-white text-md font-medium">{{ $item->users[0]->user->name }}</p>
                            <p class="text-white text-sm">{{ $item->last_message }}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="fixed bottom-0 left-0 w-full">
        <button class="bg-transparent flex justify-center border border-neutral-300 text-white hover:bg-neutral-300 text-sm px-3 py-2 rounded-xl w-full">
            Nova Conversa
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff" class="ml-2">
                <path d="M120-160v-600q0-33 23.5-56.5T200-840h480q33 0 56.5 23.5T760-760v203q-10-2-20-2.5t-20-.5q-10 0-20 .5t-20 2.5v-203H200v400h283q-2 10-2.5 20t-.5 20q0 10 .5 20t2.5 20H240L120-160Zm160-440h320v-80H280v80Zm0 160h200v-80H280v80Zm400 280v-120H560v-80h120v-120h80v120h120v80H760v120h-80ZM200-360v-400 400Z"/>
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('newMessage', (event) => {
           //console.log('nova mensagem', event);
       });
    });
</script>