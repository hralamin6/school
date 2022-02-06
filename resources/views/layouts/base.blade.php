<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')

</head>
<body class="dark:bg-darkBg text-tahiti scrollbar-none" x-data="{nav: false, dark: $persist(false)}" :class="{'dark': dark}">
<div class="dark:bg-darkBg flex h-screen" :class="{ 'overflow-hidden': nav }">
    <div x-cloak
         x-show="nav"
         x-transition:enter="transition ease-in-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>
    <livewire:admin.sidebar-component />
    <div class="flex flex-col flex-1 w-full">
        <livewire:admin.header-component />
        <main class="h-full overflow-y-auto dark:bg-darkBg">
            <div class="m-2">
                <div class="flex justify-between gap-4 mb-2">
                    <p class="text-gray-700 dark:text-gray-200 text-xl font-semibold">Dashboard v2</p>
                    <div class="flex text-sm gap-1">
                        <span class="text-blue-500 dark:text-blue-400">Home</span>
                        <span class="text-gray-500 dark:text-gray-200">/</span>
                        <span class="text-gray-500 dark:text-gray-300">Dashboard v2</span>
                    </div>
                </div>
                @yield('body')
            </div>
        </main>
    </div>
</div>
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
</body>
</html>
