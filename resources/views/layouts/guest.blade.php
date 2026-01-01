<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DolphiDay')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

                <!-- Desktop & Tablet -->
                <div class="hidden sm:flex justify-between items-center">
                    
                    <!-- Logo + Title -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-90 transition">
                        <img 
                            src="{{ asset('image/Logo-Assets.png') }}" 
                            alt="DolphiDay Logo" 
                            class="h-8 w-auto"
                        >
                        <span class="text-2xl font-bold text-blue-600">
                            DolphiDay
                        </span>
                    </a>

                    <!-- Hashtag -->
                    <span class="text-sm font-medium text-blue-500">
                        #YouNeverWalkAlone
                    </span>
                </div>

                <!-- Mobile -->
                <div class="sm:hidden flex flex-col items-center space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <img 
                            src="{{ asset('image/Logo-Assets.png') }}" 
                            alt="DolphiDay Logo" 
                            class="h-8 w-auto"
                        >
                        <span class="text-xl font-bold text-blue-600">
                            DolphiDay
                        </span>
                    </a>

                    <span class="text-xs font-medium text-blue-500">
                        #YouNeverWalkAlone
                    </span>
                </div>

            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                 © {{ date('Y') }} DolphiDay
            </div>
        </footer>

    </div>
</body>
</html>
