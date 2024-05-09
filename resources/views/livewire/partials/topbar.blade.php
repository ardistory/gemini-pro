<div class="fixed z-10 w-full py-5 px-10 backdrop-blur-sm flex justify-between items-center">
    <div>
        <span class="flex items-center gap-1 font-semibold">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M2.25 6a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V6Zm3.97.97a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Zm4.28 4.28a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <a wire:navigate href="/" class="font-bold text-xl hover:text-[#9099FF]">ArdiPutra</a>
        </span>
    </div>

    {{-- Mobile --}}
    <div x-data="{ showNavbar: false }">
        <div x-on:click="showNavbar = !showNavbar" class="block md:hidden cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path x-show="!showNavbar" stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                <path x-show="showNavbar" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>
        <div x-show="showNavbar" x-on:click.away="showNavbar = false"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="relative">
            <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-800 rounded-md border border-gray-800 bg-black-vite shadow-lg"
                role="menu">
                <div class="p-2">
                    <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                        Menu
                    </strong>

                    @foreach ($menus as $menu)
                        <a @if ($menu['title'] != 'Support') wire:navigate @endif
                            href="{{ $menu['title'] != 'Support' ? $menu['url'] : null }}"
                            class="@if (ucfirst(Route::current()->uri) == $menu['title']) text-[#9099FF] bg-gray-800 @endif block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-gray-300"
                            role="menuitem">
                            {{ $menu['title'] == 'Api' ? strtoupper($menu['title']) : $menu['title'] }}
                        </a>
                    @endforeach
                </div>
                @auth
                    <div class="p-2">
                        <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                            General
                        </strong>

                        <a href="#"
                            class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                            role="menuitem">
                            Settings
                        </a>
                    </div>
                @endauth
                <div class="p-2">
                    <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                        AUTHENTICATE
                    </strong>

                    @auth
                        <button wire:click='logout'
                            class="font-semibold flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm bg-red-500">
                            Logout
                        </button>
                    @else
                        <a wire:navigate href="{{ route('login') }}"
                            class="font-semibold flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm hover:bg-gradient-to-b hover:from-pink-vite hover:to-blue-vite bg-gradient-to-b from-blue-vite to-pink-vite text-transparent bg-clip-text">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Desktop --}}
    <div class="w-1/2 hidden justify-between md:flex">
        <div class="flex gap-5">
            @foreach ($menus as $menu)
                <a @if ($menu['title'] != 'Support') wire:navigate @endif wire:key='{{ $menu['title'] }}'
                    class="@if (ucfirst(Route::current()->uri) == $menu['title']) text-[#9099FF] bg-pink-vite/5 rounded-md @endif font-medium hover:text-[#9099FF] px-2 flex items-center gap-1"
                    href="{{ $menu['url'] }}">
                    <div>
                        {!! $menu['svg'] !!}
                    </div>
                    {{ $menu['title'] == 'Api' ? strtoupper($menu['title']) : $menu['title'] }}
                </a>
            @endforeach
        </div>
        <div class="flex gap-5 items-center">
            @auth
                <livewire:partials.alert-topbar />
                <div x-data="{ showNavbarDesktop: false }">
                    <div x-on:click="showNavbarDesktop = !showNavbarDesktop"
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <img class="rounded-full" src="{{ asset('assets/img/Griffith-red-blue.jpg') }}">
                    </div>
                    <div x-show="showNavbarDesktop" x-on:click.away="showNavbarDesktop = false"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                        class="relative">
                        <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-800 rounded-md border border-gray-800 bg-black-vite shadow-lg"
                            role="menu">
                            @auth
                                <div class="p-2">
                                    <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                                        General
                                    </strong>

                                    <a href="#"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                                        role="menuitem">
                                        Settings
                                    </a>
                                </div>
                            @endauth
                            <div class="p-2">
                                <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                                    AUTHENTICATE
                                </strong>

                                @auth
                                    <button wire:click='logout'
                                        class="font-semibold flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm bg-red-500">
                                        Logout
                                    </button>
                                @else
                                    <a wire:navigate href="{{ route('login') }}"
                                        class="font-semibold flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm hover:bg-gradient-to-b hover:from-pink-vite hover:to-blue-vite bg-gradient-to-b from-blue-vite to-pink-vite text-transparent bg-clip-text">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <a wire:navigate
                    class="font-medium hover:text-[#9099FF] px-2 hover:rounded-full bg-gradient-to-b from-blue-vite to-pink-vite bg-clip-text text-transparent"
                    href="{{ route('login') }}">
                    Login
                </a>
            @endauth
        </div>
    </div>
</div>
