@extends('layouts.app')
@section('title','Beranda')

@section('content')
<section class="grid md:grid-cols-2 gap-12 items-center">
  <div>
    <span class="text-xs bg-cyan-500/10 text-cyan-400 px-3 py-1 rounded-full">
      OFFICIAL MERCHANDISE
    </span>

    <h1 class="text-4xl md:text-5xl font-bold mt-4">
      Dukung Persela<br>
      <span class="text-cyan-400">Dengan Gaya</span>
    </h1>

    <p class="text-white/70 mt-4">
      Platform resmi penjualan jersey Persela Lamongan dengan sistem modern.
    </p>

    <div class="mt-6 flex gap-4">
      <a href="/produk" class="px-6 py-3 bg-cyan-500 rounded-lg">
        Lihat Produk
      </a>
      <a href="/login" class="px-6 py-3 border border-white/20 rounded-lg">
        Login
      </a>
    </div>
  </div>

  <div class="flex justify-center">
    <div class="bg-white/5 p-3 rounded-2xl">
      <img src="https://down-id.img.susercontent.com/file/id-11134207-7r98o-lkuvtj32elncb8"
           class="w-72 rounded-xl">
    </div>
  </div>
</section>

<!-- PRODUK UNGGULAN -->
<section class="mt-24">
  <h2 class="text-2xl font-bold text-center mb-10">
    Produk <span class="text-cyan-400">Unggulan</span>
  </h2>

  <div id="unggulan" class="grid md:grid-cols-3 gap-8"></div>
</section>
@endsection

@push('scripts')
<script src="/products.js"></script>
<script>
document.addEventListener("products-loaded", () => {
  const el = document.getElementById("unggulan");
  el.innerHTML = "";

  PRODUCTS.slice(0, 3).forEach(p => {
    el.innerHTML += `
      <div class="bg-white/5 p-3 rounded-xl hover:scale-105 transition">
        <img src="${p.image}" class="rounded-lg mb-4">
        <h3 class="font-semibold">${p.name}</h3>
        <p class="text-cyan-400">Rp ${p.price.toLocaleString("id-ID")}</p>
        <a href="/produk/${p.id}" class="block mt-4 text-center bg-cyan-500 py-2 rounded-lg">
          Lihat Detail
        </a>
      </div>
    `;
  });
});
</script>
@endpush
