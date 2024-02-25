<div class="mt-4 w-[90%] md:w-[50%] ring-1 ring-white p-4 rounded-md">
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
    <div wire:loading class="w-full flex justify-center mt-2">
        Loading...
    </div>
</div>

</div>
