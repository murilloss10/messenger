<x-layouts.app>
    <div class="flex justify-center">
        <div class="h-20 w-full md:w-4/5 flex fixed top-0 items-center justify-between sm:rounded-t-lg rounded-b-lg px-4 mb-5">
            <div class="flex items-center">
                <img class="size-14 rounded-full object-cover"
                    src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
                <p class="ml-3 text-2xl font-semibold">Penguin</p>
            </div>
        </div>
    </div>
    
    <livewire:message.send :$chat />
</x-layoust.app>