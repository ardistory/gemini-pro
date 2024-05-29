<div class="flex justify-center w-full max-h-dvh md:min-h-dvh box-border">
    <div class="grid grid-cols-12 grid-rows-12 md:grid-rows-12 w-full gap-5 mt-20 mb-10 mx-5 md:mt-20">
        <div
            class="relative col-span-12 row-span-2 md:col-span-4 md:row-span-6 bg-white/5 backdrop-blur-sm rounded p-3 flex justify-center items-center overflow-hidden">
            <span
                class="text-5xl font-bold before:w-64 before:h-64 before:bg-gradient-to-br before:from-red-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[90px]">
                <div class="flex items-center gap-2">
                    <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z"
                            clip-rule="evenodd" />
                    </svg>
                    Dashboard
                </div>
            </span>
        </div>
        <div
            class="col-span-12 row-span-8 md:col-span-8 md:row-span-12 bg-white/5 backdrop-blur-sm rounded px-3 py-5 text-black flex flex-col justify-center before:w-56 before:h-56 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-green-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[170px]">
            {!! $chart->container() !!}
            <script src="{{ $chart->cdn() }}"></script>

            {{ $chart->script() }}
        </div>
        <div
            class="col-span-6 row-span-2 md:col-span-2 md:row-span-6 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <span
                class="text-2xl font-bold inline-block before:w-40 before:h-40 before:bg-gradient-to-br before:from-green-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">738</span>
            <span class="text-xs">more hits left</span>
            <button
                class="inline-flex items-center justify-center rounded-full shadow-xl shadow-green-500 px-2 py-0.5 bg-emerald-700 text-emerald-100 gap-1">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <p class="whitespace-nowrap text-sm">Upgrade</p>
            </button>
        </div>
        <div
            class="relative col-span-6 row-span-2 md:col-span-2 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <span
                class="text-lg font-semibold before:w-40 before:h-40 before:bg-gradient-to-br before:from-blue-950 before:from-50% before:to-indigo-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">
                Last Hit API</span>
            <span class="text-xs bg-gradient-to-r from-zinc-700 to-black shadow-xl shadow-black px-2 rounded-md">
                {{ now() }}
            </span>
        </div>
        <div
            class="relative col-span-6 row-span-2 md:col-span-1 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                        clip-rule="evenodd" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
            </div>
            <span
                class="font-bold text-sm  before:w-40 before:h-40 before:bg-gradient-to-br before:from-blue-500 before:from-50% before:to-blue-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">Text
                AI</span>
            <span class="text-xl inline-flex items-center font-bold">
                UP
                <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                    </svg>
                </div>
            </span>
        </div>
        <div
            class="relative col-span-6 row-span-2 md:col-span-1 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <span
                class="font-bold text-sm before:w-40 before:h-40 before:bg-gradient-to-br before:from-green-500 before:from-50% before:to-blue-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">Image
                AI</span>
            <span class="text-xl inline-flex items-center font-bold">
                UP
                <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                    </svg>
                </div>
            </span>
        </div>
    </div>
</div>
