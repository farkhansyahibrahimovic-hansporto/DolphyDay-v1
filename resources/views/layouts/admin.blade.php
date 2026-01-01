<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - DolphiDay</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

<div class="min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav x-data="{ open: false }"
         class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3">
                    <img
                        src="{{ asset('image/Logo-Assets.png') }}"
                        class="h-8 w-auto"
                        alt="DolphiDay Logo"
                    >
                    <span class="text-xl font-bold text-blue-600">
                        DolphiDay Admin
                    </span>
                </a>

                <!-- DESKTOP MENU -->
                <div class="hidden sm:flex items-center gap-8">

                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-medium transition
                       {{ request()->routeIs('admin.dashboard')
                           ? 'text-blue-600'
                           : 'text-gray-500 hover:text-blue-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="text-sm font-medium transition
                       {{ request()->routeIs('admin.users.*')
                           ? 'text-blue-600'
                           : 'text-gray-500 hover:text-blue-600' }}">
                        Users
                    </a>

                    <!-- Admin Name -->
                    <span class="text-sm text-gray-600">
                        {{ user()->name }}
                    </span>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="text-sm text-red-500 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>

                </div>

                <!-- MOBILE BUTTON -->
                <button
                    @click="open = !open"
                    class="sm:hidden p-2 rounded-md hover:bg-gray-100 focus:outline-none"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path x-show="!open"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>
        </div>

        <!-- MOBILE MENU -->
        <div x-show="open"
             x-transition
             class="sm:hidden bg-white border-t border-gray-200">

            <div class="px-4 py-4 space-y-4">

                <a href="{{ route('admin.dashboard') }}"
                   @click="open = false"
                   class="block text-gray-700">
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}"
                   @click="open = false"
                   class="block text-gray-700">
                    Users
                </a>

                <!-- Admin Name -->
                <div class="pt-4 border-t text-sm text-gray-600">
                    {{ user()->name }}
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="text-sm text-red-500 hover:text-red-600">
                        Logout
                    </button>
                </form>

            </div>
        </div>

    </nav>

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- CONTENT -->
    <main class="flex-1 py-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} DolphiDay
    </footer>

</div>

</body>
</html>
