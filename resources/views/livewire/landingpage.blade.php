<div class="w-full min-h-screen flex flex-col md:flex-row justify-around items-center mb-14 md:mb-0">
    <div
        class="mt-[20%] md:mt-[10%] mb-[10%] text-center min-h-[50%] flex flex-col items-center justify-center before:w-32 before:h-32 before:bg-white before:absolute before:-z-50 before:rounded-full before:blur-[150px]">
        <p
            class="mx-auto max-w-sm text-6xl font-semibold bg-gradient-to-tl from-indigo-500 to-pink-500 text-transparent bg-clip-text">
            Free AI Gateway For <span class="text-[#DFDFD6]">Developers</span>
        </p>
        <a wire:navigate href="{{ route('login') }}"
            class="mt-10 shadow-xl shadow-[#9099ff] hover:shadow-2xl hover:shadow-[#9099ff] transition-all duration-200 inline-block rounded-full border-l-2 border-t-2 border-r-2 border-[#9099ff] px-12 py-3 text-sm font-medium hover:bg-[#9099ff] hover:text-white">
            Get Started
        </a>
    </div>
    <div
        class="mt-[10%] mb-[10%] w-full md:w-auto flex relative select-none min-h-[50%] md:min-h-0 flex-col md:flex-row items-center justify-center">
        <div
            class="before:absolute before:block before:w-96 before:h-96 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-pink-vite before:to-50% before:-z-50 before:rounded-full before:blur-[120px] before:-translate-x-[0%] before:translate-y-[50%] md:before:translate-x-[7%] md:before:-translate-y-[15%]">
            <div
                class="bg-gradient-to-r from-blue-vite/50 to-pink-vite/50 backdrop-blur-sm w-full rounded-t-lg text-center font-semibold">
                Response Image</div>
            <img class="shadow-lg w-96 md:w-72 rounded-b-lg user-drag-none" src="{{ asset('assets/img/api-img.png') }}">
        </div>
        <div class="relative left-0 md:-left-16 top-16">
            <div
                class="bg-gradient-to-r from-blue-vite/50 to-pink-vite/50 backdrop-blur-sm w-full rounded-t-lg text-center font-semibold">
                Response
                Text</div>
            <img class="shadow-lg w-96 md:w-72 rounded-b-lg user-drag-none"
                src="{{ asset('assets/img/api-text.png') }}">
        </div>
    </div>
</div>
