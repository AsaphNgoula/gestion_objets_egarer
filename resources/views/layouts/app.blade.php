<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title') — DschangLost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F1F5F9]">
    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>
    
    {{-- FOOTER --}}
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
