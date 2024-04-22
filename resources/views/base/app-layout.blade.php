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
</head>

<body class="bg-black-vite text-white-vite font-Inter">
    <livewire:partials.topbar>
        {{ $slot }}
        <livewire:partials.footer>
            @vite('resources/js/app.js')
</body>

</html>
