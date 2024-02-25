<div class="mt-4 w-[50%] ring-1 ring-white p-4 rounded-md">
    <div class="w-full">
        <input wire:model.live='query' class="w-full outline-none rounded-md text-black px-2 py-1" type="text"
            placeholder="Search country..">
    </div>
    @if (count($getProduct) > 0)
        @foreach ($getProduct as $index => $product)
            <div
                class="mt-2 first:mt-0 flex justify-between ring-1 ring-white hover:ring hover:ring-blue-500 transition duration-200 px-4 py-2 rounded-md">
                <div>
                    {{ $index + 1 }}
                </div>
                <div class="w-[50%] flex justify-between">
                    <div>
                        {{ $product['name_product'] }}
                    </div>
                    <div>
                        {{ $product['price'] }}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div
            class="mt-2 first:mt-0 flex justify-between ring-1 ring-white hover:ring hover:ring-blue-500 transition duration-200 px-4 py-2 rounded-md">
            <div class="w-full flex justify-center">
                No Data!
            </div>
        </div>
</div>
@endif

<div class="w-full flex justify-center">
    {{ $getProduct->links() }}
</div>

</div>
