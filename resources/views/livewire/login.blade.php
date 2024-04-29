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

        <form action="#" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            <div>
                <label for="email" class="sr-only">Email</label>

                <div class="relative">
                    <input type="email"
                        class="text-black w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter email" />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </span>
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input type="password"
                        class="text-black w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter password" />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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

    <div x-data="{ notifRegister: {{ session('notifRegister') ? true : false }} }" x-show="notifRegister"
        class="fixed top-2 z-50 rounded border-s-4 border-green-500 bg-green-50 p-4 flex items-center gap-2">
        <strong class="block font-medium text-green-800">registration was successful</strong>
        <div class="text-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
</div>