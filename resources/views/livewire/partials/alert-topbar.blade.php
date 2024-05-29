<div x-data="{ showAlertDesktop: false }" x-on:click="showAlertDesktop=true" class="relative cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd"
            d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z"
            clip-rule="evenodd" />
    </svg>
    <div
        class="text-xs bg-gradient-to-br from-red-500 to-red-600 rounded-full absolute w-[14px] h-[14px] flex items-center justify-center top-0 right-0">
        1
    </div>
    <div x-show="showAlertDesktop" x-on:click.away="showAlertDesktop = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative">
        <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-800 rounded-md border border-gray-800 bg-black-vite shadow-lg"
            role="menu">
            <div class="p-2">
                <strong class="block p-2 text-xs font-medium uppercase text-gray-400 dark:text-gray-500">
                    Notifications
                </strong>

                <div
                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                    Welcome to this site😊
                </div>
            </div>
        </div>
    </div>
</div>
