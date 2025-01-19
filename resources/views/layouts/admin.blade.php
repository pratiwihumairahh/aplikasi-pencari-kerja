<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kartu Pencari Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white border-r border-gray-200 fixed h-full">
            <!-- Logo -->
            <div class="px-4 py-3 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-id-card text-blue-500 text-xl"></i>
                    <h1 class="text-lg font-semibold text-gray-800">Kartu Pencari Kerja</h1>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex flex-col h-[calc(100%-64px)]">
                <nav class="flex-1 px-2 py-3">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                        class="flex items-center space-x-2 px-4 py-2.5 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                        <i class="fas fa-home w-5 text-gray-500"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Data Master Section -->
                    <div class="mt-6 mb-2">
                        <p class="px-4 text-xs font-medium text-gray-400 uppercase">DATA MASTER</p>
                    </div>

                    <a href="{{ route('admin.pencari-kerja.index') }}"
                        class="flex items-center space-x-2 px-4 py-2.5 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.pencari-kerja.*') ? 'bg-gray-100' : '' }}">
                        <i class="fas fa-users w-5 text-gray-500"></i>
                        <span>Pencari Kerja</span>
                    </a>

                    <a href="{{ route('admin.riwayat-pekerjaan.index') }}"
                        class="flex items-center space-x-2 px-4 py-2.5 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.riwayat-pekerjaan.*') ? 'bg-gray-100' : '' }}">
                        <i class="fas fa-briefcase w-5 text-gray-500"></i>
                        <span>Riwayat Pekerjaan</span>
                    </a>

                    <!-- Laporan Section -->
                    <div class="mt-6 mb-2">
                        <p class="px-4 text-xs font-medium text-gray-400 uppercase">LAPORAN</p>
                    </div>

                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center space-x-2 px-4 py-2.5 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.laporan') ? 'bg-gray-100' : '' }}">
                        <i class="fas fa-chart-bar w-5 text-gray-500"></i>
                        <span>Laporan</span>
                    </a>
                </nav>

                <!-- User Profile -->
                <div class="border-t border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center space-x-3">
                            <div class="p-2">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700">Administrator</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" 
                                class="w-full flex items-center justify-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                
                <!-- Quick Actions -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.pencari-kerja.create') }}" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 text-sm transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Pencari Kerja</span>
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Add any JavaScript functionality here
    </script>
</body>
</html>
