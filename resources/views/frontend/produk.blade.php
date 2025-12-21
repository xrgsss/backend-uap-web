@extends('layouts.app')
@section('title','Produk')

@section('content')
<h1 class="text-3xl font-bold mb-10">Koleksi Jersey</h1>

<div class="grid md:grid-cols-3 gap-8" id="produk"></div>
@endsection

@push('scripts')
<script src="/products.js"></script>
<script>
const el = document.getElementById('produk');

PRODUCTS.forEach(p => {
  el.innerHTML += `
    <div class="bg-white/5 p-5 rounded-xl">
      <img src="${p.image}" class="rounded-lg mb-4">
      <h3 class="font-semibold">${p.name}</h3>
      <p class="text-cyan-400">Rp ${p.price.toLocaleString()}</p>
      <a href="/produk/${p.id}" class="block mt-4 bg-cyan-500 py-2 text-center rounded-lg">
        Detail Produk
      </a>
    </div>
  `;
});
</script>
@endpush
