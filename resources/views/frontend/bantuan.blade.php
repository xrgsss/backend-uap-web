@extends('layouts.app')

@section('title', 'Bantuan')

@section('content')
<section class="max-w-5xl mx-auto px-8 py-20">
    <h1 class="text-4xl font-bold mb-8">
        Pusat <span class="text-sky-400">Bantuan</span>
    </h1>

    <div class="space-y-6 text-white/80">
        <div>
            <h3 class="font-semibold text-lg">Apakah jersey ini original?</h3>
            <p>Ya, semua produk adalah merchandise resmi Persela Lamongan.</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg">Bagaimana cara pemesanan?</h3>
            <p>Pilih produk → Tambah ke Keranjang → Checkout.</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg">Apakah melayani luar kota?</h3>
            <p>Kami melayani pengiriman ke seluruh Indonesia.</p>
        </div>

        <div>
            <h3 class="font-semibold text-lg">Apakah tersedia COD?</h3>
            <p>COD tersedia untuk area tertentu.</p>
        </div>
    </div>
</section>
@endsection
