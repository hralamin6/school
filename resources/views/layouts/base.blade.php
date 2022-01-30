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
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-lightBg dark:bg-darkBg text-tahiti" x-data="{nav: false, dark: $persist(false)}" :class="{'dark': dark}">
<div class="flex h-screen bg-gray-50" :class="{ 'overflow-hidden': nav }">
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
    <nav x-cloak @click.outside="nav = false" class="md:block overflow-x-hidden overflow-y-hidden border-2 shadow-2xl bg-white inset-y-0 z-10 fixed md:relative flex-shrink-0 w-64 overflow-y-auto bg-white dark:bg-darkSidebar"
         :class="{'hidden': nav == false}">
        <div class="h-14 border-b flex px-4 py-2 gap-3">
            <span class="w-10 h-10 rounded-full bg-purple-600 border shadow-xl"></span>
            <span class="my-auto text-xl text-gray-500 font-mono">Adminlte</span>
        </div>
        <div class="h-16 border-b flex px-4 py-2 gap-3">
            <span class="w-10 h-10 rounded-full bg-indigo-600 border shadow-xl"></span>
            <span class="my-auto text-sm text-gray-600 font-medium">Alexander Pairace</span>
        </div>
        <div class="m-2 mt-4 flex">
            <input type="search" class="border text-gray-200 text-sm border-gray-300 bg-gray-100 px-2 w-48 h-9 rounded-md rounded-r-none" placeholder="Search">
            <a href="" class="border border-gray-300 bg-gray-100 rounded-l-none p-2 h-9 rounded-md"><x-h-o-search class="w-5 text-gray-600"/></a>
        </div>
        <div class="overflow-hidden h-screen scrollbar-none overflow-y-scroll scrollbar-thumb-gray-400 scrollbar-track-white  scrollbar-thin">
            <div class="capitalize font-mono">
                <a href="{{route('admin.dashboard')}}" class="navMenuLink {{Route::is('admin.dashboard')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('dashboard')}}</span>
                </a>
                <div @if(Route::is('admin.setup.*')) x-data="{setup: true}" @else x-data="{setup: false}" @endif>
                    <div @click="setup= !setup"  class="navMenuLink {{Route::is('admin.setup.*')?'navActive':'navInactive'}}">
                        <x-h-o-home class="w-5"/><span class="">{{__('setup')}}</span>
                        <x-h-o-chevron-left x-show="!setup" class="w-4 ml-auto"/><x-h-o-chevron-down x-show="setup" class="w-4 ml-auto"/>
                    </div>
                    <div x-show="setup" class="text-sm" x-collapse>
                        <a href="{{route('admin.setup.label')}}" class="subNavMenuLink {{Route::is('admin.setup.label')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-sparkles class="w-4"/>
                            <span class="">{{__('class')}}</span>
                        </a>
                        <a href="{{route('admin.setup.group')}}" class="subNavMenuLink {{Route::is('admin.setup.group')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-sparkles class="w-4"/>
                            <span class="">{{__('group')}}</span>
                        </a>
                    </div>
                </div>
                <div @if(Route::is('admin.setup.*')) x-data="{other: false}" @else x-data="{other: true}" @endif>
                    <div @click="other= !other"  class="navMenuLink {{Route::is('admin.setup.*')?'navActive':'navInactive'}}">
                        <x-h-o-home class="w-5"/><span class="">{{__('other')}}</span>
                        <x-h-o-chevron-left x-show="!other" class="w-4 ml-auto"/><x-h-o-chevron-down x-show="other" class="w-4 ml-auto"/>
                    </div>
                    <div x-show="other" class="text-sm" x-collapse>

                        <a href="{{route('admin.setup.shift')}}" class="subNavMenuLink {{Route::is('admin.setup.shift')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-light-bulb class="w-4"/>
                            <span class="">{{__('shift')}}</span>
                        </a>
                        <a href="{{route('admin.setup.medium')}}" class="subNavMenuLink {{Route::is('admin.setup.medium')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-light-bulb class="w-4"/>
                            <span class="">{{__('medium')}}</span>
                        </a>
                        <a href="{{route('admin.setup.session')}}" class="subNavMenuLink {{Route::is('admin.setup.session')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-light-bulb class="w-4"/>
                            <span class="">{{__('session')}}</span>
                        </a>
                        <a href="{{route('admin.setup.section')}}" class="subNavMenuLink {{Route::is('admin.setup.section')?'subNavActive':'subNavInactive'}}">
                            <x-h-o-light-bulb class="w-4"/>
                            <span class="">{{__('section')}}</span>
                        </a>
                    </div>
                </div>
                <a href="{{route('admin.setup.label')}}" class="navMenuLink {{Route::is('admin.setup.label')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('class')}}</span>
                </a>
                <a href="{{route('admin.setup.group')}}" class="navMenuLink {{Route::is('admin.setup.group')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('group')}}</span>
                </a>
                <a href="{{route('admin.setup.shift')}}" class="navMenuLink {{Route::is('admin.setup.shift')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('shift')}}</span>
                </a>
                <a href="{{route('admin.setup.medium')}}" class="navMenuLink {{Route::is('admin.setup.medium')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('medium')}}</span>
                </a>
                <a href="{{route('admin.setup.session')}}" class="navMenuLink {{Route::is('admin.setup.session')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('session')}}</span>
                </a>
                <a href="{{route('admin.setup.section')}}" class="navMenuLink {{Route::is('admin.setup.section')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('section')}}</span>
                </a>
                <a href="{{route('admin.setup.label')}}" class="navMenuLink {{Route::is('admin.setup.label')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('class')}}</span>
                </a>
                <a href="{{route('admin.setup.group')}}" class="navMenuLink {{Route::is('admin.setup.group')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('group')}}</span>
                </a>
                <a href="{{route('admin.setup.shift')}}" class="navMenuLink {{Route::is('admin.setup.shift')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('shift')}}</span>
                </a>
                <a href="{{route('admin.setup.medium')}}" class="navMenuLink {{Route::is('admin.setup.medium')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('medium')}}</span>
                </a>
                <a href="{{route('admin.setup.session')}}" class="navMenuLink {{Route::is('admin.setup.session')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('session')}}</span>
                </a>
                <a href="{{route('admin.setup.section')}}" class="navMenuLink {{Route::is('admin.setup.section')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('section')}}</span>
                </a>
                <a href="{{route('admin.setup.label')}}" class="navMenuLink {{Route::is('admin.setup.label')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('class')}}</span>
                </a>
                <a href="{{route('admin.setup.group')}}" class="navMenuLink {{Route::is('admin.setup.group')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('group')}}</span>
                </a>
                <a href="{{route('admin.setup.shift')}}" class="navMenuLink {{Route::is('admin.setup.shift')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('shift')}}</span>
                </a>
                <a href="{{route('admin.setup.medium')}}" class="navMenuLink {{Route::is('admin.setup.medium')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('medium')}}</span>
                </a>
                <a href="{{route('admin.setup.session')}}" class="navMenuLink {{Route::is('admin.setup.session')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('session')}}</span>
                </a>
                <a href="{{route('admin.setup.section')}}" class="navMenuLink {{Route::is('admin.setup.section')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/>
                    <span class="">{{__('section')}}</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="flex flex-col flex-1 w-full">
        <header class="w-full h-14 bg-lightHeader border-b" x-data="{search: false}">
            <div class="flex justify-between gap-6 p-4 relative inline-block">
                <div class="flex justify-start space-x-4 md:space-x-9 text-gray-500 text-sm z-0" :class="{'hidden': search}">
                    <button @click="nav= !nav" x-on:click.stop><x-h-o-menu class="w-5"/></button>
                    <a href="{{route('admin.dashboard')}}" class="capitalize">home</a>
                    <a href="{{route('admin.dashboard')}}" class="capitalize">contact</a>

                </div>
                <div class="w-full hidden md:block">
                    <div class="flex justify-center space-x-2 text-gray-500 text-sm mt-0">
                        <input type="search" class="w-1/2 border-none bg-gray-200 text-xs rounded-2xl h-6" placeholder="Type your query…">
                        <a href=""><x-h-o-search class="w-5 text-gray-600"/></a>
                    </div>
                </div>

                <div x-cloak x-show="search" class="w-full absolute inset-0 inline-flex items-center justify-center z-50 flex space-x-2 text-gray-500 text-sm mt-5 font-bold"
                     x-transition:enter.scale.60
                     x-transition:leave.scale.40
                >
                    <input type="search" class="w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="Type your query…">
                    <a href=""><x-h-o-search class="w-5 text-gray-600"/></a>
                    <a href="" @click.prevent="search=false"><x-h-o-x class="w-5 text-gray-600"/></a>

                </div>

                <div class="flex justify-end space-x-4 md:space-x-8 text-gray-600 text-sm font-bold z-0" :class="{'hidden': search}">
                    <a class="md:hidden" @click.prevent="search=!search"><x-h-o-search class="w-5"/></a>
                    <a href="" @click="dark=!dark"><x-h-o-sun x-show="dark" class="w-5"/><x-h-o-moon x-show="!dark" class="w-5"/></a>

                    <a class="relative" href=""><x-h-o-chat class="w-5"/>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center p-0.5 text-xs text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">12</span>
                    </a>
                    <a href=""><x-h-o-bell class="w-5"/></a>
                    <a href="{{route('admin.setup.group')}}"><x-h-o-login class="w-5"/></a>
                    <a href=""><x-h-o-user-add class="w-5"/></a>

                </div>
            </div>
        </header>
                <main class="h-full overflow-y-auto dark:bg-darkBg">
                    adsf
                </main>

        {{--        @yield('body')--}}
    </div>
</div>

{{--<div class="flex flex-3 gap-2" x-data="{nav: false}">--}}


{{--    <div class="flex flex-grow flex-col flex-1 w-full">--}}
{{--        <main class="h-full overflow-y-auto">--}}
{{--            adsf--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</div>--}}
{{--            @yield('body')--}}
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
</body>
</html>
