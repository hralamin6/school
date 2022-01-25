<div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    :class="{ 'overflow-hidden': isNavbarOpen }"
>
<div
        x-show="isNavbarOpen"
        x-transition:enter="transition ease-in-out duration-1000"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>
    <nav class="lg:relative fixed inset-y-0 z-20 flex-shrink-0 overflow-y-auto w-64 shadow-xl h-screen bg-white dark:bg-gray-800  transform lg:transform-none "
         :class="{'translate-x-0': isNavbarOpen === true, '-translate-x-full': isNavbarOpen === false}">
        <div @click.away="isNavbarOpen = false" class="capitalize text-gray-600 dark:text-gray-400 px-8 justify-start">
            <div class="text-purple-600 font-semibold text-lg my-6">Sidebar</div>
            <ul class="flex flex-col space-y-5" >
                <li class="rounded-md activated"><a href=""><i class="pr-3 fi fi-rr-sun"></i> <span class="font-semibold">Home</span></a></li>
                <li class="hover:bg-purple-600"><a href=""><i class="pr-3 fi fi-rr-moon"></i> <span class="font-semibold">Contact</span></a></li>
                <li class="hover:bg-purple-600"><a href=""><i class="pr-3 fi fi-rr-sign-in-alt"></i> <span class="font-semibold">Login</span></a></li>
                <li class="hover:bg-purple-600"><a href=""><i class="pr-3 fi fi-rr-address-book"></i> <span class="font-semibold">Register</span></a></li>
                <li class="relative" x-data="{ page: false, toggle() { this.page = ! this.page } }">
                    <a class="cursor-pointer" @click="toggle()"><i class="pr-3 fi fi-rr-address-book"></i><span class="font-semibold">Register</span> <i class="pl-9 text-xs fi fi-rr-angle-down"></i></a>
                    <ul  x-show="page" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"><a class="w-full" href="pages/create-account.html">Create account</a></li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"><a class="w-full" href="pages/create-account.html">Create account</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <header class="relative z-0 lg:flex-grow">
        <div class="h-16 bg-white dark:bg-gray-800 shadow-md flex p-5 justify-between m-auto space-x-3">
                <div class="flex justify-center capitalize text-purple-700 dark:text-purple-300 text-xl">
                <label for="open" class=" pt-1"><i class="fi fi-rr-align-left md:hidden"></i></label>
                <input id="open" style="display: none" type="checkbox" x-on:change="toggleNavbar">
                    <button @click="toggleNavbar">asdf</button>

                <a class="pl-4 md:pl-0" href="{{route('admin.dashboard')}}">Imamhujur</a>
            </div>
            <div class="flex justify-center capitalize md:space-x-10 space-x-6 text-purple-700 dark:text-purple-300 text-xl">
               <template x-if="darkMode">
                   <a @click="toggleDarkMode" class="pt-1"><i class="fi fi-rr-sun"></i></a>
               </template>

               <template x-if="!darkMode">
                   <a @click="toggleDarkMode" class="pt-1"><i class="fi fi-rr-moon"></i></a>
               </template>
{{--                <a class="pt-1" href="{{route('admin.dashboard')}}"><i class="fi fi-rr-moon"></i></a>--}}
                <a class="pt-1" href=""><i class="fi fi-rr-sign-in-alt"></i></a>
                <a class="pt-1" href=""><i style="" class="fi fi-rr-address-book"></i></a>
            </div>
        </div>
    </header>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>
<div>a</div>

</div>
