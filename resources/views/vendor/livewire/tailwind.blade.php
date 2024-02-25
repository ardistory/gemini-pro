@if ($paginator->hasPages())
    <div class="select-none flex items-end my-2">

        @if (!$paginator->onFirstPage())
            {{-- First Page Link --}}
            <a class="mx-1 px-2 py-2 bg-black ring-1 ring-white text-white font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer"
                wire:click="gotoPage(1)">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                    </svg>
                </div>
            </a>
            @if ($paginator->currentPage() > 2)
                {{-- Previous Page Link --}}
                <a class="mx-1 px-2 py-2 bg-black ring-1 ring-white text-white font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer"
                    wire:click="previousPage">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                </a>
            @endif
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <!--  Show active page two pages before and after it.  -->
                    @if ($page == $paginator->currentPage())
                        <span
                            class="mx-1 px-2 py-2 bg-white ring-1 ring-white text-black font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer">{{ $page }}</span>
                    @elseif (
                        $page === $paginator->currentPage() + 1 ||
                            $page === $paginator->currentPage() + 2 ||
                            $page === $paginator->currentPage() - 1 ||
                            $page === $paginator->currentPage() - 2)
                        <a class="mx-1 px-2 py-2 bg-black ring-1 ring-white text-white font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer"
                            wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if ($paginator->lastPage() - $paginator->currentPage() >= 2)
                <a class="mx-1 px-2 py-2 bg-black ring-1 ring-white text-white font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer"
                    wire:click="nextPage" rel="next">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </a>
            @endif
            <a class="mx-1 px-2 py-2 bg-black ring-1 ring-white text-white font-bold text-center hover:bg-white hover:text-black rounded-lg  cursor-pointer"
                wire:click="gotoPage({{ $paginator->lastPage() }})">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
        @endif
    </div>
@endif
