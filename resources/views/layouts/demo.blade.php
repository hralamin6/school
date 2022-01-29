<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" x-data="data()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{--        <script src="//unpkg.com/alpinejs" defer></script>--}}
    <script src="{{asset('assets/js/init-alpine.js')}}"></script>
    {{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">--}}
</head>
<body>
<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    @livewire('admin.sidebar-component')
    <div class="flex flex-col flex-1 w-full">
        @livewire('admin.header-component')
        @yield('body')
    </div>
</div>
@stack('js')
<script>
    document.addEventListener("turbolinks:request-start", function(event) {
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                isSideMenuOpen: false,
                init() {
                    this.isSideMenuOpen = false
                },
            }))
        })

    })
</script>
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
</body>
</html>
