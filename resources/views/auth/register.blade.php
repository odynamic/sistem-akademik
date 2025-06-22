<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Daftar Akun</h2>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                    Daftar
                </button>
            </div>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>
