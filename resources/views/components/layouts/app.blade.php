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
            class="fixed left-0 z-20 flex h-svh flex-col bg-neutral-200 p-4 transition-transform duration-300 md:w-1/5 md:translate-x-0 md:relative"
            x-bind:class="{
                'translate-x-0 w-80 md:w-96': showSidebar, 
                '-translate-x-60 w-70 md:w-80': !showSidebar
            }"
            aria-label="sidebar navigation">
            
            <a href="#" class="ml-2 w-fit text-2xl font-bold text-neutral-900">
                <span class="sr-only">homepage</span>
                <h2>Messenger</h2>
            </a>

            <livewire:list.conversation :$chats />
        </nav>

        <div class="h-svh overflow-y-auto w-full md:pt-4 md:px-4">
            {{ $slot }}
        </div>

        <button
            class="fixed right-4 top-4 z-20 rounded-full bg-black p-4 md:hidden text-neutral-100"
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
