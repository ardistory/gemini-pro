<div class="w-[90%] md:w-[50%] mt-10 mb-10">
    <div class="w-full flex justify-center font-semibold text-2xl">
        <div class="relative">
            @@ardiStory___
            <div
                class="absolute text-xs font-normal bg-gradient-to-tr from-pink-500 to-sky-500 px-1 rounded-full left-0 top-0 -translate-y-3 translate-x-3">
                Instagram
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="relative w-full flex justify-between gap-2 mb-4">
            <input wire:model='question' wire:keydown.enter='generateResponse'
                class="w-full outline-none rounded-xl text-black px-2 py-1" type="text"
                placeholder="{{ $wdyt[rand(0, 9)] }}">
            <div class="absolute right-1 top-1 select-none bg-black shadow shadow-black px-2 rounded-lg">
                <span wire:loading.remove>Enter</span>
                <span wire:loading>
                    <svg class="w-3 h-3 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </span>
            </div>
        </div>
        @if (count($response) > 0)
            <div
                class="mt-1 first:mt-0 flex justify-between ring-1 ring-white transition duration-200 px-4 py-2 rounded-md">
                <div>
                    @foreach ($response as $respon)
                        <p>{{ $respon }}</p>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
</div>
