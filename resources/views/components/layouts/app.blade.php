<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Messageria' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=send" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireScripts
</head>

<body>

    <div x-data="{ showSidebar: true }" class="relative flex w-full flex-col md:flex-row">
        <a class="sr-only" href="#main-content">skip to the main content</a>

        <div x-cloak x-show="showSidebar" class="fixed inset-0 z-10 bg-neutral-950/10 backdrop-blur-sm md:hidden"
            aria-hidden="true" x-on:click="showSidebar = false" x-transition.opacity></div>

        <nav x-cloak
            class="fixed left-0 z-20 flex h-svh flex-col bg-neutral-100 p-4 transition-transform duration-300 md:w-1/5 md:translate-x-0 md:relative dark:bg-neutral-800"
            x-bind:class="{
                'translate-x-0 w-80 md:w-96': showSidebar, 
                '-translate-x-60 w-70 md:w-80': !showSidebar
            }"
            aria-label="sidebar navigation">
            
            <a href="#" class="ml-2 w-fit text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                <span class="sr-only">homepage</span>
                <h2>Messenger</h2>
            </a>

            <div class="relative my-4 flex w-full max-w-xl flex-col gap-1 text-neutral-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="2"
                    class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-400/50"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="search"
                    class="w-full rounded-xl bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-950/50 dark:focus-visible:outline-white"
                    name="search" aria-label="Search" placeholder="Search" />
            </div>

            <div class="flex flex-col gap-2 overflow-y-auto scrollbar-thin pb-1">
                {{-- @foreach ($chats as $item)
                    <a href="" class="flex items-center rounded-none gap-2 ps-1 dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100 text-white">
                        <img class="size-8 rounded-full object-cover"
                            src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
                        <div>
                            <p class="text-md font-semibold">{{ $item->chat->users[0]->user->name }}</p>
                            <p class="text-sm">{{ $item->chat->last_message }}</p>
                        </div>
                    </a>
                @endforeach --}}
                <livewire:list.conversation :$chats />
            </div>
        </nav>

        <div class="h-svh overflow-y-auto w-full md:pt-4 md:px-4 dark:bg-neutral-950">
            <div class="flex justify-center">
                <div class="h-20 w-full md:w-4/5 flex fixed top-0 items-center justify-between sm:rounded-t-lg rounded-b-lg px-4 dark:bg-neutral-800 mb-5">
                    <div class="flex items-center">
                        <img class="size-14 rounded-full object-cover"
                            src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="avatar" />
                        <p class="ml-3 text-2xl text-white font-semibold">Penguin</p>
                    </div>
                </div>
            </div>
            
            {{ $slot }}
        </div>

        <button
            class="fixed right-4 top-4 z-20 rounded-full bg-black p-4 md:hidden text-neutral-100 dark:bg-white dark:text-black"
            x-on:click="showSidebar = ! showSidebar">
            <svg x-show="showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="size-5" aria-hidden="true">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
            <svg x-show="! showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                class="size-5" aria-hidden="true">
                <path
                    d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z" />
            </svg>
            <span class="sr-only">sidebar toggle</span>
        </button>
    </div>
</body>

</html>
