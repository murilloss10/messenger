<div class="h-full w-full flex flex-col items-end">
    <div class="h-full w-full p-2">
        <div class="flex w-full flex-col py-24 gap-4">
            @foreach ($this->allMessages as $item)
                @if ($item['sender']['id'] == $this->authenticatedUser['id'])
                    <!--[if BLOCK]><![endif]-->
                    <div class="flex items-end gap-2" wire:key="message-{{ $item['_id'] }}">
                        <div
                            class="ml-auto flex max-w-[70%] flex-col gap-2 rounded-l-xl rounded-tr-xl bg-black p-4 text-sm text-neutral-100 md:max-w-[60%] dark:bg-white dark:text-black">
                            {!! nl2br(e($item['content'])) !!}
                            <span class="ml-auto text-xs">{{ $item['created_at']->format('H:i') }}</span>
                        </div>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->
                @else
                    <!--[if BLOCK]><![endif]-->
                    <div class="flex items-end gap-2" wire:key="message-{{ $item['_id'] }}">
                        <div
                            class="mr-auto flex max-w-[70%] flex-col gap-2 rounded-r-xl rounded-tl-xl bg-neutral-100 p-4 text-neutral-600 md:max-w-[60%] dark:bg-neutral-800 dark:text-neutral-400">
                            <div class="text-sm">
                                {!! nl2br(e($item['content'])) !!}
                            </div>
                            <span class="ml-auto text-xs">{{ $item['created_at']->format('H:i') }}</span>
                        </div>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->
                @endif
            @endforeach
        </div>
    </div>

    <div class="w-full flex justify-center">
        <form wire:submit="sendNewMessage" class="max-h-44 w-full md:w-4/5 flex fixed bottom-0 items-end justify-between rounded-t-lg dark:bg-neutral-950 border-t">
            <div class="flex w-full items-center px-3 py-2 rounded-b-none rounded-lg dark:bg-neutral-800">
                <textarea rows="2" wire:model="contentOfNewMessage"
                    class="block mx-4 p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-950/50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Sua mensagem..." wire:keydown.enter="sendNewMessage"></textarea>
                <button type="submit"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>
    </div>
</div>
