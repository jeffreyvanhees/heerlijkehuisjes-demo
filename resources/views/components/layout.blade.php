<html lang="nl">
<head>
    <title>Heerlijke Huisjes - @yield('title')</title>

    @vite('resources/css/app.css')
</head>
<body>
<div class="container mx-auto p-10">
    <x-header />
    {{ $slot }}
</div>
</body>
</html>