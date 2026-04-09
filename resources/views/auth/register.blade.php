<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fisherman Registration - Earners</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6 font-sans">

    <div class="w-full max-w-md bg-white p-12 rounded-2xl shadow-xl text-center">
        <h2 class="text-3xl font-bold text-[#0047AB] mb-10">Fisherman Registration</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="text-left">
                <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Full Name</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#0047AB] outline-none transition"
                    placeholder="e.g. Juan Dela Cruz">
            </div>

            <div class="text-left">
                <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Contact Number</label>
                <input type="text" name="contact_number" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#0047AB] outline-none transition"
                    placeholder="09123456789">
            </div>

            <div class="text-left">
                <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Create Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#0047AB] outline-none transition"
                    placeholder="••••••••">
            </div>

            {{-- Hidden confirm field to satisfy Laravel validation --}}
            <input type="hidden" name="password_confirmation" id="pw_confirm">

            <button type="submit" onclick="document.getElementById('pw_confirm').value = document.getElementsByName('password')[0].value"
                class="w-full bg-[#0047AB] text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-blue-800 transition transform active:scale-95">
                Register Account
            </button>
        </form>

        <div class="mt-8">
            <a href="{{ route('login') }}" class="text-[#0047AB] font-bold text-sm hover:underline">Already have an account? Sign In</a>
        </div>
    </div>

</body>
</html>