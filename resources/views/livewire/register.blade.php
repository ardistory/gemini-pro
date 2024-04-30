<div>
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <section class="relative flex h-32 items-end lg:col-span-5 lg:h-full xl:col-span-6">
            <img src="{{ asset('assets/img/Paint_Drip_Wallpaper_Final2.png') }}"
                class="user-drag-none absolute inset-0 h-full w-full object-cover opacity-80" />
            <div class="hidden lg:relative lg:block lg:p-12">
                <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                    Register your account
                </h2>
            </div>
        </section>

        <main
            class="backdrop-blur-sm flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
            <div class="max-w-xl lg:max-w-3xl">
                <form wire:submit='register' class="relative grid mt-6 grid-cols-10 gap-5 w-full">
                    <div class="col-span-10">
                        <label for="Username" class="block text-sm font-medium text-white-vite">
                            Username
                        </label>

                        <input wire:model.live='username' type="text" id="Username"
                            class="mt-1 w-full rounded-md @error('username') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('username')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                        @if ($isTaken && strlen($username) >= 8)
                            <div class="absolute text-xs text-red-500 font-medium">Username has been taken</div>
                        @endif
                    </div>
                    <div class="col-span-5">
                        <label for="Firstname" class="block text-sm font-medium text-white-vite">
                            Firstname
                        </label>

                        <input wire:model.live='first_name' type="text" id="Firstname"
                            class="mt-1 w-full rounded-md @error('first_name') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('first_name')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-5">
                        <label for="Lastname" class="block text-sm font-medium text-white-vite">
                            Lastname
                        </label>

                        <input wire:model.live='last_name' type="text" id="Username"
                            class="mt-1 w-full rounded-md @error('last_name') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('last_name')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="col-span-10 before:w-96 before:h-96 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-pink-vite before:to-50% before:block before:absolute before:-z-50 before:rounded-full before:top-[10%] before:left-[10%] before:blur-[200px]">
                        <label for="Email" class="block text-sm font-medium text-white-vite"> Email </label>

                        <input wire:model.live='email' type="email" id="Email"
                            class="mt-1 w-full rounded-md @error('email') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('email')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-10">
                        <label for="password_confirmation" class="block text-sm font-medium text-white-vite">
                            Password
                        </label>

                        <input wire:model.live='password_confirmation' type="password" id="password_confirmation"
                            class="mt-1 w-full rounded-md @error('password') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('password_confirmation')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-10">
                        <label for="Password" class="block text-sm font-medium text-white-vite">Repeat Password </label>

                        <input wire:model.live='password' type="password" id="Password"
                            class="mt-1 w-full rounded-md @error('password') border-red-500 ring-1 ring-red-500 @else border-gray-200 @enderror bg-white text-sm text-black-vite shadow-sm" />
                        @error('password')
                            <div class="absolute text-xs text-red-500 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-10 flex flex-col items-center sm:gap-4 relative">
                        <button type="submit"
                            class="inline-block shrink-0 rounded-md bg-gradient-to-r from-zinc-700 to-black px-12 py-3 text-sm font-medium text-white-vite hover:bg-gradient-to-r border-t-[1px] focus:outline-none transition-all duration-300 before:w-44 before:h-10 before:bg-white before:block before:absolute before:top-0 before:blur-2xl before:translate-y-7 before:-z-50 before:hover:blur-[100px] before:transition-all before:duration-500">
                            Create an account
                        </button>

                        <p class="mt-4 text-sm text-white-vite sm:mt-0">
                            Already have an account?
                            <a wire:navigate href="{{ route('login') }}" class="text-white-vite underline">Log in</a>.
                        </p>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
