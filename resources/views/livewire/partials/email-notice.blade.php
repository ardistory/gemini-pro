<div class="w-full h-screen flex justify-center items-center">
    <div class="rounded border border-white-vite bg-white-vite p-4">
        <strong class="block font-medium text-black-vite">you have to verify your email</strong>

        <p class="mt-2 text-sm text-black-vite">
            The verification email has been sent, please check the email
        </p>
        <button wire:click='refresh' class="mt-2 bg-gradient-to-br from-blue-vite to-pink-vite px-2 rounded-md">
            Refresh
        </button>
        <button wire:click='resend' class="mt-2 bg-gradient-to-br from-blue-vite to-pink-vite px-2 rounded-md">
            Resend Email Verification
        </button>
    </div>
</div>
