<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tugas Mandiri')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen flex flex-col">
    <nav class="bg-white shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold text-xl text-blue-600">ITS Web</a>
            <div class="space-x-4">
                <a href="{{ route('dashboard.mahasiswa', ['nrp' => '5025241046']) }}" class="text-gray-600 hover:text-blue-600">Mahasiswa</a>
                <a href="{{ route('dashboard.kalkulator', ['ip1' => 3.5, 'ip2' => 4.0]) }}" class="text-gray-600 hover:text-blue-600">Kalkulator</a>
                <a href="{{ route('agent.show', ['type' => 'security-harness']) }}" class="text-gray-600 hover:text-blue-600">Agent</a>
            </div>
        </div>
    </nav>
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        @yield('content')
    </main>
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500 mt-auto">
        &copy; {{ date('Y') }} Tugas Mandiri
    </footer>
</body>
</html>
