<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Persela Store')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #0f1b2d, #05080f);
        }
    </style>
</head>
<body class="text-white">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-[#070c17]/90 backdrop-blur border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold">
            Persela<span class="text-cyan-400">Store</span>
        </a>

        <div class="flex items-center gap-6 text-sm">
            <a href="/" class="hover:text-cyan-400">Beranda</a>
            <a href="/produk" class="hover:text-cyan-400">Produk</a>
            <a href="/cart" class="hover:text-cyan-400">Keranjang</a>
            <a href="/kontak" class="hover:text-cyan-400">Kontak</a>
            <a href="/bantuan" class="hover:text-cyan-400">Bantuan</a>
            <a href="/tentang" class="hover:text-cyan-400">Tentang</a>

            <span id="authMenu"></span>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-16">
    @yield('content')
</main>

<!-- AUTH SCRIPT -->
<script>
const token = localStorage.getItem('token');
const authMenu = document.getElementById('authMenu');

if (token) {
    authMenu.innerHTML = `
        <a href="/dashboard" class="px-4 py-2 bg-cyan-500 rounded-lg text-sm">Dashboard</a>
        <button onclick="logout()" class="px-4 py-2 bg-red-500 rounded-lg text-sm">Logout</button>
    `;
} else {
    authMenu.innerHTML = `
        <a href="/login" class="px-4 py-2 bg-cyan-500 rounded-lg text-sm">Login</a>
    `;
}

function logout() {
    localStorage.removeItem('token');
    location.href = '/login';
}
</script>

@stack('scripts')
</body>
</html>
