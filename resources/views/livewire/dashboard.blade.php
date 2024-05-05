<div class="flex justify-center w-full max-h-dvh md:min-h-dvh box-border">
    <div class="grid grid-cols-12 grid-rows-7 md:grid-rows-12 w-full gap-5 mt-20 mb-10 mx-5 md:mt-20">
        <div
            class="relative col-span-12 row-span-1 md:col-span-4 md:row-span-6 bg-white/5 backdrop-blur-sm rounded p-3 flex justify-center items-center overflow-hidden">
            <span
                class="text-5xl font-bold before:w-64 before:h-64 before:bg-gradient-to-br before:from-red-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[90px]">Dashboard</span>
        </div>
        <div
            class="col-span-12 row-span-3 md:col-span-8 md:row-span-12 bg-white/5 backdrop-blur-sm rounded px-3 py-5 text-black flex flex-col justify-center before:w-56 before:h-56 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-green-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[170px]">
            {!! $chart->container() !!}
            <script src="{{ $chart->cdn() }}"></script>

            {{ $chart->script() }}
        </div>
        <div
            class="col-span-6 row-span-1 md:col-span-2 md:row-span-6 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
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
            class="relative col-span-6 row-span-1 md:col-span-2 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <span
                class="text-lg font-semibold before:w-40 before:h-40 before:bg-gradient-to-br before:from-blue-950 before:from-50% before:to-indigo-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">
                Last Hit API</span>
            <span class="text-xs bg-gradient-to-r from-zinc-700 to-black shadow-xl shadow-black px-2 rounded-md">
                {{ now() }}
            </span>
        </div>
        <div
            class="relative col-span-6 row-span-1 md:col-span-1 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
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
            class="relative col-span-6 row-span-1 md:col-span-1 md:row-span-3 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
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
