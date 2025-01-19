<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Kartu Pencari Kerja') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="h-full bg-gray-100">
    <div class="min-h-full flex flex-col">
        <!-- Top Navigation -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold text-gray-800">
                                Kartu Pencari Kerja
                            </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('user.dashboard') }}" class="@if(request()->routeIs('user.dashboard')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('user.profile.edit') }}" class="@if(request()->routeIs('user.profile.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Profil
                            </a>
                            <a href="{{ route('user.experience.index') }}" class="@if(request()->routeIs('user.experience.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Pengalaman Kerja
                            </a>
                            <a href="{{ route('user.documents.index') }}" class="@if(request()->routeIs('user.documents.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dokumen
                            </a>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <span class="text-gray-700 mr-3">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="@if(request()->routeIs('user.dashboard')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('user.profile.edit') }}" class="@if(request()->routeIs('user.profile.*')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Profil
                    </a>
                    <a href="{{ route('user.experience.index') }}" class="@if(request()->routeIs('user.experience.*')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Pengalaman Kerja
                    </a>
                    <a href="{{ route('user.documents.index') }}" class="@if(request()->routeIs('user.documents.*')) bg-indigo-50 border-indigo-500 text-indigo-700 @else border-transparent text-gray-500 @endif block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dokumen
                    </a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1">
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 sm:hidden">
            <div class="grid grid-cols-4 gap-1">
                <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center justify-center py-2 @if(request()->routeIs('user.dashboard')) text-indigo-600 @else text-gray-500 @endif">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-xs mt-1">Dashboard</span>
                </a>
                <a href="{{ route('user.profile.edit') }}" class="flex flex-col items-center justify-center py-2 @if(request()->routeIs('user.profile.*')) text-indigo-600 @else text-gray-500 @endif">
                    <i class="fas fa-user text-lg"></i>
                    <span class="text-xs mt-1">Profil</span>
                </a>
                <a href="{{ route('user.experience.index') }}" class="flex flex-col items-center justify-center py-2 @if(request()->routeIs('user.experience.*')) text-indigo-600 @else text-gray-500 @endif">
                    <i class="fas fa-briefcase text-lg"></i>
                    <span class="text-xs mt-1">Pengalaman</span>
                </a>
                <a href="{{ route('user.documents.index') }}" class="flex flex-col items-center justify-center py-2 @if(request()->routeIs('user.documents.*')) text-indigo-600 @else text-gray-500 @endif">
                    <i class="fas fa-file text-lg"></i>
                    <span class="text-xs mt-1">Dokumen</span>
                </a>
            </div>
        </nav>
    </div>

    @stack('scripts')
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('#mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
