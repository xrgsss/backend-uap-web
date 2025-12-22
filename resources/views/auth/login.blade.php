@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow w-96">
        <h2 class="text-xl font-bold mb-4 text-center">Login</h2>

        <input id="email" type="email" placeholder="Email"
               class="w-full border p-2 mb-3 rounded">

        <input id="password" type="password" placeholder="Password"
               class="w-full border p-2 mb-4 rounded">

        <button onclick="login()"
                class="w-full bg-blue-600 text-white py-2 rounded">
            Login
        </button>

        <p id="error" class="text-red-500 text-sm mt-3 text-center"></p>
    </div>
</div>

<script>
function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
    .then(res => res.json())
    .then(data => {
        if (data.access_token) {
            // ✅ PENTING
            localStorage.setItem('token', data.access_token);
            localStorage.setItem('isLogin', 'true');
            localStorage.setItem('userEmail', email);

            window.location.href = '/checkout';
        } else {
            document.getElementById('error').innerText =
                data.message ?? 'Login gagal';
        }
    })
    .catch(() => {
        document.getElementById('error').innerText = 'Server error';
    });
}
</script>
@endsection
