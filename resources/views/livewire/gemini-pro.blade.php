<div class="w-[90%] md:w-[50%]">
    <div class="w-full flex justify-center font-semibold text-2xl">
        @@ardiStory___
    </div>
    <div class="mt-4 ring-1 ring-white p-4 rounded-md">
        <div class="w-full flex justify-between gap-2">
            <input wire:model='question' wire:keydown.enter='generateResponse'
                class="w-full outline-none rounded-md text-black px-2 py-1" type="text" placeholder="Pertanyaan..">
        </div>
        @if ($response != '')
            <div
                class="mt-2 first:mt-0 flex justify-between ring ring-blue-500 transition duration-200 px-4 py-2 rounded-md">
                <div>
                    {{ $response }}
                </div>
            </div>
        @endif
        <div wire:loading
            class="fixed w-full h-screen left-0 top-0 backdrop-blur-sm flex justify-center items-center mt-2">
            <div class="bg-black text-white rounded-full p-3">
                <svg class="w-10 h-10 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </div>
        </div>
    </div>

</div>
</div>
