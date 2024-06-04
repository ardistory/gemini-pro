<div class="flex justify-center w-full max-h-dvh md:min-h-dvh box-border">
    <div class="grid grid-cols-12 grid-rows-12 md:grid-rows-12 w-full gap-5 mt-20 mb-10 mx-5 md:mt-20">
        <div
            class="relative col-span-12 row-span-2 order-1 md:order-1 md:col-span-4 md:row-span-12 bg-white/5 backdrop-blur-sm rounded p-3 flex justify-center items-center overflow-hidden">
            <span
                class="text-5xl font-bold before:w-64 before:h-64 before:bg-gradient-to-br before:from-red-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[90px]">
                <div class="flex items-center gap-2">
                    <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M10.5 3.798v5.02a3 3 0 0 1-.879 2.121l-2.377 2.377a9.845 9.845 0 0 1 5.091 1.013 8.315 8.315 0 0 0 5.713.636l.285-.071-3.954-3.955a3 3 0 0 1-.879-2.121v-5.02a23.614 23.614 0 0 0-3 0Zm4.5.138a.75.75 0 0 0 .093-1.495A24.837 24.837 0 0 0 12 2.25a25.048 25.048 0 0 0-3.093.191A.75.75 0 0 0 9 3.936v4.882a1.5 1.5 0 0 1-.44 1.06l-6.293 6.294c-1.62 1.621-.903 4.475 1.471 4.88 2.686.46 5.447.698 8.262.698 2.816 0 5.576-.239 8.262-.697 2.373-.406 3.092-3.26 1.47-4.881L15.44 9.879A1.5 1.5 0 0 1 15 8.818V3.936Z"
                            clip-rule="evenodd" />
                    </svg>
                    Test
                </div>
            </span>
        </div>
        <div
            class="col-span-12 row-span-4 order-2 md:col-span-4 md:row-span-10 bg-white/5 backdrop-blur-sm rounded pl-3 py-3 text-black flex flex-col justify-center before:w-56 before:h-56 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-green-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[110px]">
            <div
                class="overflow-y-auto w-full h-full scrollbar-thin scroll-smooth scrollbar-thumb-white-vite scrollbar-track-transparent">
                <div class="flex flex-col pr-2">
                    <div wire:loading wire:target='testChat'
                        class="absolute -z-10 rounded-md overflow-hidden w-full h-full top-0 left-0">
                        <div
                            class="w-full h-full before:w-56 before:h-56 before:animate-pulse before:bg-gradient-to-br before:from-yellow-500 before:from-50% before:to-blue-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[100px] absolute top-0 left-0">
                        </div>
                    </div>
                    @if ($isRunOutQuota)
                        <div class="mt-2 bg-red-400/30 px-2 py-1 rounded-md w-[90%]">
                            <span class="text-white text-lg font-semibold">Model</span>
                            <p class="text-white text-xs">
                                API quota has run out, chat my Telegram:
                                <span class="text-yellow-500"><a
                                        href="https://t.me/storynetsound">@@storynetsound</a></span>
                            </p>
                        </div>
                    @else
                        @if ($chats)
                            @foreach ($chats as $chat)
                                @if ($chat['role'] == 'user')
                                    <div class="flex justify-end">
                                        <div class="bg-green-200/25 px-2 py-1 rounded-md max-w-[90%] text-end">
                                            <span
                                                class="text-white text-sm font-semibold">{{ Auth::user()->username }}</span>
                                            @foreach ($chat['text'] as $chatUser)
                                                <p class="text-white text-xs">
                                                    {{ $chatUser }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="mt-2 bg-blue-400/30 px-2 mb-2 last:mb-0 py-1 rounded-md w-max max-w-[90%]">
                                        <span class="text-white text-sm font-semibold">Model</span>
                                        @foreach ($chat['text'] as $chatModel)
                                            <p class="text-white text-xs">
                                                {{ $chatModel }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="bg-blue-400/30 px-2 py-1 rounded-md w-max max-w-[90%]">
                                <span class="text-white text-lg font-semibold">Model</span>
                                <p class="text-white text-xs">
                                    I have an interesting topic
                                <p class="text-white text-xs">"{{ $randomRecommend[rand(0, 10)] }}"</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div
            class="col-span-12 row-span-4 order-4 md:order-3 md:col-span-4 md:row-span-10 bg-white/5 backdrop-blur-sm rounded overflow-hidden text-black flex flex-col justify-center before:w-56 before:h-56 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-green-500 before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[170px]">
            @if ($isFailedGenerateImage == true)
                <div
                    class="absolute top-0 left-0 w-full h-full bg-red-500 text-white-vite flex justify-center items-center">
                    Generate Failed!
                </div>
            @endif
            <img src="{{ $urlImage }}">
            <span class="absolute left-2 bottom-2 text-xs text-white-vite/50 font-semibold">
                {{ $prompt }}
            </span>
        </div>
        <div
            class="col-span-12 row-span-1 order-3 md:order-4 md:col-span-4 md:row-span-2 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <div class="w-full items-center flex justify-around">
                <span
                    class="text-sm font-bold inline-block before:w-40 before:h-40 before:bg-gradient-to-br before:from-green-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">TextAI</span>
                <div wire:loading.remove wire:target='testChat' class="flex">
                    <input wire:model='message' wire:keydown.enter='testChat' wire:loading.attr="disabled"
                        type="text" placeholder="Type something" autofocus="true"
                        class="text-black-vite inline-flex items-center justify-center rounded-l-md px-2 py-0.5 bg-white gap-1 border-none ring-0 focus:ring-0">
                    <button wire:click='clearChat' id="clearChat" class="bg-red-100 px-1 text-red-700 rounded-r-md">
                        <div>
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div
            class="relative col-span-12 row-span-1 order-5 md:order-5 md:col-span-4 md:row-span-2 bg-white/5 backdrop-blur-sm rounded p-3 flex flex-col justify-center items-center overflow-hidden">
            <div class="w-full items-center flex justify-around">
                <span
                    class="text-sm font-bold inline-block before:w-40 before:h-40 before:bg-gradient-to-br before:from-blue-500 before:from-50% before:to-pink-vite before:to-50% before:absolute before:-z-50 before:top-[50%] before:left-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[70px]">ImageAI</span>
                <div wire:loading.remove wire:target='generateImage' class="flex relative">
                    <input wire:keydown.enter='generateImage' type="text" placeholder="Prompt"
                        class="text-black-vite inline-flex items-center justify-center rounded-md px-2 py-0.5 bg-white gap-1 border-none ring-0 focus:ring-0">
                </div>
            </div>
        </div>
    </div>
</div>
