<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ERP Logistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0d9488 0%, #134e4a 100%);
        }
        .glass {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.12);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

    <div class="glass shadow-2xl rounded-2xl w-full max-w-md p-8 border border-teal-400/30 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-white/10 to-transparent pointer-events-none rounded-2xl"></div>

        <!-- Logo / Title -->
        <div class="text-center mb-8 relative">
            <div class="w-16 h-16 bg-white text-teal-700 mx-auto rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold mt-4 tracking-tight">ERP Logistik</h2>
            <p class="text-teal-200 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <!-- Alert -->
        @if (session('error'))
            <div class="bg-red-600/20 border border-red-500 text-red-200 text-sm rounded-lg p-3 text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6 relative">
            @csrf

            <div>
                <label class="block text-sm mb-2 text-teal-200 font-medium">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:ring-2 focus:ring-teal-400 focus:border-transparent outline-none transition"
                    placeholder="contoh@email.com" required>
            </div>

            <div>
                <label class="block text-sm mb-2 text-teal-200 font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:ring-2 focus:ring-teal-400 focus:border-transparent outline-none transition"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="w-full py-2.5 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-white font-semibold rounded-lg shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                Masuk Sekarang
            </button>
        </form>

        <!-- Footer -->
        <p class="text-teal-100/80 text-xs text-center mt-8">
            © {{ date('Y') }} <span class="font-semibold text-white">ERP Logistik</span> — All Rights Reserved
        </p>
    </div>
</body>
</html>
