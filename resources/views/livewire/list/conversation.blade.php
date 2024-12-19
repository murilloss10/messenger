<div wire:poll.2s>
    @foreach ($chats as $item)
        <a href="{{ route('chat', $item->chat->id) }}"
            class="flex items-center rounded-none gap-2 ps-1 dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100 text-white">
            <img class="size-8 rounded-full object-cover"
                src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
            <div>
                <p class="text-md font-semibold">{{ $item->chat->users[0]->user->name }}</p>
                <p class="text-sm">{{ $item->chat->last_message }}</p>
            </div>
        </a>
    @endforeach
</div>

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('newMessage', (event) => {
           console.log('nova mensagem', event);
           
       });
    });
</script>