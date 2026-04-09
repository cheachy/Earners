<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earners</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="w-64 bg-[#0047AB] text-white flex flex-col">
            <div class="p-6 flex items-center space-x-2">
                <i class="fa-solid fa-fish-fins text-2xl"></i>
                <h1 class="text-2xl font-bold tracking-tight">Earners</h1>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <!-- UPDATED LINKS -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-house"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('catch-log.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('catch-log.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-fish"></i> <span>Catch Log</span>
                </a>
                <a href="{{ route('payouts.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('payouts.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-dollar-sign"></i> <span>Payouts</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- HEADER -->
            <header class="bg-white p-4 flex justify-end items-center space-x-6 shadow-sm px-8">
                <div class="flex items-center space-x-4 border-r pr-6">
                    <i class="fa-regular fa-bell text-xl text-gray-400 cursor-pointer hover:text-gray-600"></i>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-red-500 font-bold hover:underline">Sign Out</button>
                        </form>
                    </div>
                    <div class="w-10 h-10 bg-[#0047AB] text-white rounded-full flex items-center justify-center shadow-inner">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </header>

            <!-- THIS IS WHERE THE UNIQUE PAGE CONTENT GOES -->
            <main class="p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>