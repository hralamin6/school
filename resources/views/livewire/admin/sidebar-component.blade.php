<nav x-cloak @click.outside="nav = false" class="md:block overflow-x-hidden overflow-y-hidden shadow-2xl bg-white inset-y-0 z-10 fixed md:relative flex-shrink-0 w-64 overflow-y-auto bg-white dark:bg-darkSidebar"
     :class="{'hidden': nav == false}">
    <div class="h-14 border-b dark:border-gray-600 flex px-4 py-2 gap-3">
        <span class="w-10 h-10 rounded-full bg-purple-600 border dark:border-gray-600 shadow-xl"></span>
        <span class="my-auto text-xl text-gray-500 font-mono dark:text-gray-300">Adminlte</span>
    </div>
    <div class="h-16 border-b dark:border-gray-600 flex px-4 py-2 gap-3">
        <span class="w-10 h-10 rounded-full bg-indigo-600 border dark:border-gray-600 shadow-xl"></span>
        <span class="my-auto text-sm text-gray-600 font-medium dark:text-gray-300">Alexander Pairace</span>
    </div>
    <div class="m-2 mt-4 flex">
        <input type="search"  class="border dark:border-gray-500 dark:bg-gray-600 dark:placeholder-gray-300 text-gray-200 text-sm border-gray-300 bg-gray-100 px-2 w-48 h-9 rounded-md rounded-r-none" placeholder="Search">
        <a href="" class="border  dark:bg-gray-600 border-gray-300 dark:border-gray-500 bg-gray-100 rounded-l-none p-2 h-9 rounded-md"><x-h-o-search class="w-5 text-gray-600 dark:text-gray-200"/></a>
    </div>
    <div class="overflow-hidden h-screen scrollbar-none overflow-y-scroll scrollbar-thumb-gray-400 scrollbar-track-white  scrollbar-thin">
        <div class="capitalize">
            <a href="{{route('admin.dashboard')}}" class="navMenuLink {{Route::is('admin.dashboard')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('dashboard')}}</span>
            </a>
            <a href="{{route('admin.quiz')}}" class="navMenuLink {{Route::is('admin.quiz')?'navActive':'navInactive'}}">
                <x-h-o-home class="w-5"/>
                <span class="">{{__('quiz')}}</span>
            </a>
            {{--            <div @if(Route::is('admin.setup.*')) x-data="{setup: true}" @else x-data="{setup: false}" @endif>--}}
            <div  x-data="{setup: @if(Route::is('admin.setup.*')) true @else false @endif}">
                <div @click="setup= !setup"  class="navMenuLink {{Route::is('admin.setup.*')?'navActive':'navInactive'}}">
                    <x-h-o-home class="w-5"/><span class="">{{__('setup')}}</span>
                    <x-h-o-chevron-left x-show="!setup" class="w-4 ml-auto"/><x-h-o-chevron-down x-show="setup" class="w-4 ml-auto"/>
                </div>
                <div x-show="setup" class="" x-collapse>
                    <a href="{{route('admin.setup.label')}}" class="subNavMenuLink {{Route::is('admin.setup.label')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-sparkles class="w-4"/>
                        <span class="">{{__('class')}}</span>
                    </a>
                    <a href="{{route('admin.setup.group')}}" class="subNavMenuLink {{Route::is('admin.setup.group')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-sparkles class="w-4"/>
                        <span class="">{{__('group')}}</span>
                    </a>
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
            <div  x-data="{artisan: false}">
                <div @click="artisan= !artisan"  class="navMenuLink navInactive">
                    <x-h-o-home class="w-5"/><span class="">{{__('Artisan')}}</span>
                    <x-h-o-chevron-left x-show="!artisan" class="w-4 ml-auto"/><x-h-o-chevron-down x-show="artisan" class="w-4 ml-auto"/>
                </div>
                <div x-show="artisan" class="" x-collapse>
                    <a href="{{route('optimize')}}" class="subNavMenuLink {{Route::is('optimize')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-light-bulb class="w-4"/>
                        <span class="">{{__('optimize')}}</span>
                    </a>
                    <a href="{{route('migrate')}}" class="subNavMenuLink {{Route::is('migrate')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-light-bulb class="w-4"/>
                        <span class="">{{__('migrate')}}</span>
                    </a>
                    <a href="{{route('migrate.fresh')}}" class="subNavMenuLink {{Route::is('migrate.fresh')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-light-bulb class="w-4"/>
                        <span class="">{{__('migrate fresh')}}</span>
                    </a>
                    <a href="{{route('migrate.rollback')}}" class="subNavMenuLink {{Route::is('migrate.rollback')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-light-bulb class="w-4"/>
                        <span class="">{{__('migrate rollback')}}</span>
                    </a>
                    <a href="{{route('db.seed')}}" class="subNavMenuLink {{Route::is('db.seed')?'subNavActive':'subNavInactive'}}">
                        <x-h-o-light-bulb class="w-4"/>
                        <span class="">{{__('db seed')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
