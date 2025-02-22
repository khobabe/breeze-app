<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white h-screen fixed">
        <div class="p-5 text-center text-xl font-bold border-b border-gray-700">Admin Panel</div>
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-700">Dashboard</a>
            <a href="#" class="block px-6 py-3 hover:bg-gray-700">Users</a>
            <a href="#" class="block px-6 py-3 hover:bg-gray-700">Settings</a>
            <a href="#" class="block px-6 py-3 hover:bg-gray-700">Manage Tickets</a>
            <a href="{{ route('logout') }}" class="block px-6 py-3 hover:bg-red-600">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex flex-col w-full min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>
            <span class="text-gray-600">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
        </header>

        <!-- Page Content -->
        <main class="flex-grow p-6">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white text-center py-4">
            &copy; {{ date('Y') }} Admin Panel. All rights reserved.
        </footer>
    </div>

</body>

</html>
