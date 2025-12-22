@extends('layouts.app')

@section('title','Pesanan Berhasil')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center text-center">
    <h1 class="text-4xl font-bold text-cyan-400 mb-4">🎉 Pesanan Berhasil!</h1>
    <p class="text-white/70 mb-6">
        Terima kasih telah berbelanja di PerselaStore
    </p>

    <a href="/dashboard"
       class="bg-cyan-500 px-6 py-3 rounded-full text-black font-semibold">
       Lihat Riwayat Pesanan
    </a>
</div>
@endsection
