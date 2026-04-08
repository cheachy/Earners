<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Earners</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        <!-- Brand Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center space-x-2 text-[#0047AB]">
                <i class="fa-solid fa-fish-fins text-4xl"></i>
                <h1 class="text-4xl font-extrabold tracking-tight">Earners</h1>
            </div>
            <p class="text-gray-500 mt-2 font-medium">Fisheries Management System</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign In</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#0047AB] focus:border-transparent outline-none transition"
                        placeholder="name@company.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <label class="text-sm font-semibold text-gray-600">Password</label>
                        <a href="#" class="text-xs text-[#0047AB] font-bold hover:underline">Forgot?</a>
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#0047AB] focus:border-transparent outline-none transition"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[#0047AB] border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-500">Keep me signed in</label>
                </div>

                <button type="submit" 
                    class="w-full bg-[#0047AB] text-white py-3 rounded-lg font-bold text-lg shadow-lg hover:bg-blue-700 transition transform active:scale-[0.98]">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Don't have an account? 
                    <a href="#" class="text-[#0047AB] font-bold hover:underline">Register here</a>
                </p>
            </div>
        </div>
        
        <p class="text-center text-gray-400 text-xs mt-8">
            &copy; {{ date('Y') }} Earners Consolidation Logistics. All rights reserved.
        </p>
    </div>

</body>
</html>