<x-layouts.app>
    <div class="flex justify-center">
        <div class="h-20 w-full md:w-4/5 flex fixed top-0 items-center justify-between border border-neutral-700 bg-neutral-800 sm:rounded-t-lg rounded-b-lg px-4 mb-5">
            <div class="flex items-center">
                <img class="size-14 rounded-full object-cover"
                    src="{{ $chat->users[0]->user->profile_photo_url }}" alt="avatar" />

                <p class="ml-3 text-2xl font-semibold text-white truncate">
                    @foreach ($chat->participants as $participant)
                        @if ($participant['id'] != auth()->id())
                            {{ $participant['name'] }}
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
    
    <livewire:message.send :$chat />
</x-layoust.app>