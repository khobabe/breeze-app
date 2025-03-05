<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css'])
    @livewireStyles {{-- Required for Livewire --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('support.tickets') }}" wire:navigate class="text-lg font-semibold">Ticket Management</a>
            <div>
                <a href="#" class="text-gray-700 hover:text-gray-900 px-4">Profile</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 px-4">Settings</a>
                <a href="#" class="text-red-600 hover:text-red-800 px-4">Logout</a>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow p-4">
            <ul class="space-y-4">
                <li><a href="{{ route('support.tickets') }}" wire:navigate class="block text-gray-700 hover:text-gray-900">Dashboard</a>
                </li>
                <li><a href="{{ route('support.tickets') }}" wire:navigate class="block text-gray-700 hover:text-gray-900">Support
                        Tickets</a></li>
                <li><a href="{{ route('support.tickets') }}" wire:navigate class="block text-gray-700 hover:text-gray-900">Generate Tickets</a></li>
                <li><a href="#" class="block text-gray-700 hover:text-gray-900">Orders</a></li>
                <li><a href="#" class="block text-gray-700 hover:text-gray-900">Messages</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }} {{-- This is where Livewire components will be rendered --}}
        </main>
    </div>

    @livewireScripts {{-- Required for Livewire --}}
</body>

</html>
