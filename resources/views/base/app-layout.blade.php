<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ardi Putra | {{ $title ?? config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/svg/logo.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
</head>

<body
    class="bg-black-vite text-white-vite font-Inter @auth before:w-96 before:h-96 before:-z-50 before:bg-gradient-to-br before:from-blue-vite before:from-50% before:to-pink-vite before:to-50% before:block before:absolute before:left-[50%] before:top-[50%] before:translate-x-[-50%] before:translate-y-[-50%] before:rounded-full before:blur-[290px] @endauth">
    <livewire:partials.topbar>
        {{ $slot }}
        <livewire:partials.footer>
            @vite('resources/js/app.js')
            <script src="{{ asset('js/iziToast.js') }}"></script>
            @include('vendor.lara-izitoast.toast')
</body>

</html>
