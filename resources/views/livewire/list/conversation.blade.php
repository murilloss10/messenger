<div>
    <div class="flex items-center mt-4">
        <div class="relative flex w-full max-w-xl flex-col gap-1 text-neutral-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"
                class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="search" name="search" wire:model.live="search"
                class="w-full rounded-xl bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
                aria-label="Search" placeholder="Procurar..." />
        </div>
    </div>

    <div class="flex flex-col gap-2 overflow-y-auto scrollbar-thin py-1">
        <div wire:poll.visible.8s="refreshChats">
            @if ($chats)
                @foreach ($chats as $item)
                    <a href="{{ route('chat', $item->id) }}"
                        @class([
                            'bg-neutral-700' => request()->fullUrl() === url(route('chat', $item->id)),
                            'flex', 'items-center', 'gap-2', 'px-1', 'py-2', 'hover:bg-neutral-700', 'rounded-xl'
                        ])>

                        <img class="size-8 rounded-full object-cover"
                            src="{{ $item->users[0]->user->profile_photo_url }}" alt="avatar" />
                            
                        <div class="w-full">
                            <p class="text-white text-md font-medium">{{ $item->users[0]->user->name }}</p>
                            <div class="flex justify-between">
                                <p class="text-white text-xs truncate">{{ $item->last_message }}</p>
                                <p class="text-white text-xs">{{ $item->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="fixed bottom-2 left-0 w-full px-1">
        <div x-data="{modalIsOpen: false}">
            <button @click="modalIsOpen = true" type="button" class="flex justify-center items-center cursor-pointer whitespace-nowrap rounded-md bg-transparent px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 border border-neutral-300 rounded-xl w-full">
                Nova Conversa
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#ffffff" class="ml-2">
                    <path
                        d="M120-160v-600q0-33 23.5-56.5T200-840h480q33 0 56.5 23.5T760-760v203q-10-2-20-2.5t-20-.5q-10 0-20 .5t-20 2.5v-203H200v400h283q-2 10-2.5 20t-.5 20q0 10 .5 20t2.5 20H240L120-160Zm160-440h320v-80H280v80Zm0 160h200v-80H280v80Zm400 280v-120H560v-80h120v-120h80v120h120v80H760v120h-80ZM200-360v-400 400Z" />
                </svg>
            </button>
            
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-center justify-center bg-black/20 p-4 pb-8 backdrop-blur-xl sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                
                <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" class="flex w-screen flex-col gap-4 overflow-hidden rounded-md border border-neutral-700 bg-neutral-900 text-neutral-300">
                    
                    <div class="flex items-center justify-between border-b p-4 border-neutral-700 bg-neutral-950/20">
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-white">Iniciar Nova Conversa</h3>
                        <button @click="modalIsOpen = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="px-1 pt-4 pb-8">
                        @foreach ($this->users as $user)
                            <a href="{{ route('conversation', ['user' => $user->id]) }}"
                                class="flex items-center gap-2 px-1 py-2 hover:bg-neutral-700 rounded-xl">
                                <img class="size-8 rounded-full object-cover"
                                    src="{{ $user->profile_photo_url }}" alt="avatar" />
                                <div class="w-full">
                                    <p class="text-white text-md font-medium">{{ $user->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // document.addEventListener('livewire:init', () => {
        // Livewire.on('newMessage', (event) => {
            //console.log('nova mensagem', event);
        // });
    // });
</script>
