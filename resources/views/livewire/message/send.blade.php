<div class="h-full w-full flex flex-col items-end">
    <div class="h-full w-full p-2"
        x-data="{
            isViewed() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            //console.log('Elemento visível:', entry.target);
                            
                            window.scrollTo({
                                top: document.body.scrollHeight,
                                behavior: 'smooth'
                            });

                            @this.call('lastViewedMessage');
                        }
                    });
                });
        
                const container = document.getElementById('messages-container');
                const observerConfig = { childList: true };
        
                const mutationObserver = new MutationObserver((mutations) => {
                    mutations.forEach(mutation => {
                        mutation.addedNodes.forEach(node => {
                            if (node.nodeType === 1 && node.classList.contains('other-message')) {
                                observer.observe(node);
                                @this.call('newMessage');
                            }
                        });
                    });
                });
        
                mutationObserver.observe(container, observerConfig);
            }
        }" x-init="isViewed">
        <div class="flex w-full flex-col py-24 gap-4" id="messages-container">
            @foreach ($this->allMessages as $key => $item)
                @if ($item['sender']['id'] == $this->authenticatedUser['id'])
                    <!--[if BLOCK]><![endif]-->
                    <div class="flex items-end gap-2 owner-message" wire:key="message-{{ $key }}">
                        <div
                            class="ml-auto flex max-w-[70%] flex-col gap-2 rounded-l-xl rounded-tr-xl bg-black p-4 text-sm text-neutral-100 md:max-w-[60%]">
                            {!! nl2br(e($item['content'])) !!}
                            <span
                                class="ml-auto text-xs">{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->
                @else
                    <!--[if BLOCK]><![endif]-->
                    <div class="flex items-end gap-2 other-message" wire:key="message-{{ $key }}">
                        <div
                            class="mr-auto flex max-w-[70%] flex-col gap-2 rounded-r-xl rounded-tl-xl bg-neutral-200 p-4 text-black md:max-w-[60%]">
                            <div class="text-sm">
                                {!! nl2br(e($item['content'])) !!}
                            </div>
                            <span
                                class="mr-auto text-xs">{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->
                @endif
            @endforeach
        </div>
    </div>

    <div class="w-full flex justify-center">
        <form wire:submit="sendNewMessage"
            class="max-h-44 w-full md:w-4/5 flex fixed bottom-0 items-end justify-between border border-neutral-700 bg-neutral-800 rounded-t-lg">
            <div class="flex w-full items-center px-3 py-2 rounded-b-none rounded-lg">
                <textarea
                    rows="2" 
                    wire:model="contentOfNewMessage"
                    class="block mx-4 p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Sua mensagem..."
                    {{-- wire:keydown.enter="sendNewMessage"  --}}
                    required></textarea>
                <button type="submit"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 hover:bg-transparent">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="#ffffff" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>
    </div>
</div>
