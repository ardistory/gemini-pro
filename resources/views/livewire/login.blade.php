<div class="select-none relative w-full h-screen flex items-center justify-center">
    <div class="absolute w-full h-screen overflow-hidden">
        <img class="left-0 top-0 w-auto md:w-full h-full user-drag-none"
            src="{{ asset('assets/img/Paint_Drip_Wallpaper_Final2.png') }}">
    </div>
    <div class="mx-5 md:mx-0 bg-white/[0.01] backdrop-blur-sm p-5 rounded-xl max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Get started today!</h1>

            <p class="mt-4 text-white-vite">
                it all starts when you log in, don't have an account yet? Please register first to be able to enjoy this
                web feature🔥
            </p>
        </div>

        <form wire:submit='login' class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            <div>
                <label for="username" class="sr-only">Username</label>

                <div class="relative">
                    <input wire:model.live='username' type="text"
                        class="text-black w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter username" />
                    @error('username')
                        <div class="absolute text-xs font-semibold text-red-500">{{ $message }}</div>
                    @enderror
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </span>
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input wire:model.live='password' type="password"
                        class="text-black w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter password" />
                    @error('password')
                        <div class="absolute text-xs font-semibold text-red-500">{{ $message }}</div>
                    @enderror
                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-sm text-white-vite">
                    No account?
                    <a wire:navigate class="underline" href="{{ route('register') }}">Register</a>
                </p>

                <button type="submit"
                    class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white-vite">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
