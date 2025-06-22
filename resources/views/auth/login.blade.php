<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if (session('status'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600">
                    <span class="text-sm text-gray-700">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Login
            </button>

            <p class="text-center text-sm mt-4 text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
            </p>
        </form>
    </div>
</body>
</html>
