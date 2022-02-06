<header class="w-full h-14 bg-lightHeader dark:bg-darkSidebar border-b dark:border-gray-600" x-data="{search: false}">
    <div class="flex justify-between gap-6 p-4 relative inline-block">
        <div class="flex justify-start space-x-4 md:space-x-9 text-gray-500 dark:text-gray-200 text-sm z-0" :class="{'hidden': search}">
            <button @click="nav= !nav" x-on:click.stop><x-h-o-menu class="w-5 md:hidden"/></button>
            <a href="{{route('admin.dashboard')}}" class="hidden md:block capitalize">home</a>
            <a href="{{route('admin.dashboard')}}" class="hidden md:block capitalize">contact</a>

        </div>
        <div class="w-full hidden md:block">
            <div class="flex justify-center space-x-2 text-gray-500 dark:text-gray-200 text-sm mt-0">
                <input type="search" class="w-1/2 border-none dark:bg-gray-600 bg-gray-200 dark:placeholder-gray-300 text-xs rounded-2xl h-6" placeholder="Type your query…">
                <a href="" class="mt-0.5"><x-h-o-search class="w-5 dark:text-gray-200 text-gray-600"/></a>
            </div>
        </div>

        <div x-cloak x-show="search" class="w-full absolute inset-0 inline-flex items-center justify-center z-50 flex space-x-2 text-gray-500 text-sm mt-5 font-bold"
             x-transition:enter.scale.60
             x-transition:leave.scale.40
        >
            <input type="search" class="dark:bg-gray-600 dark:placeholder-gray-300 w-full bg-gray-300 text-gray-500 h-8 rounded-xl border-none text-sm" autofocus placeholder="Type your query…">
            <a href="" class="cursor-pointer"><x-h-o-search class="w-5 text-gray-600 dark:text-gray-200"/></a>
            <a href="" class="cursor-pointer" @click.prevent="search=false"><x-h-o-x class="w-5 text-gray-600 dark:text-gray-200"/></a>

        </div>

        <div class="flex justify-end space-x-8 md:space-x-12 text-gray-600 dark:text-gray-200 text-sm font-bold z-0" :class="{'hidden': search}">
            <a class="md:hidden cursor-pointer" @click.prevent="search=!search"><x-h-o-search class="w-5"/></a>
            <a class="cursor-pointer" @click="dark=!dark"><x-h-o-sun x-show="dark" class="w-5"/><x-h-o-moon x-show="!dark" class="w-5"/></a>

            <a href="{{route('message')}}" class="relative cursor-pointer" ><x-h-o-chat class="w-5"/>
                <span class="absolute top-0 right-0 inline-flex items-center justify-center p-0.5 text-xs text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">12</span>
            </a>
            <a class="cursor-pointer"><x-h-o-bell class="w-5"/></a>
            <a class="cursor-pointer"><x-h-o-login class="w-5"/></a>

        </div>
    </div>
</header>
