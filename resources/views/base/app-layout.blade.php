<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-black text-white w-full min-h-screen flex justify-center">
    {{ $slot }}
    @vite('resources/js/app.js')
</body>

</html>
