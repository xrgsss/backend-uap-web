@extends('layouts.app')
@section('title','Pesanan Saya')

@section('content')
<h1 class="text-3xl font-bold mb-8">Riwayat Pesanan</h1>

<div id="orders" class="space-y-4"></div>
@endsection

@push('scripts')
<script>
const orders = JSON.parse(localStorage.getItem('orders')) || [];
const el = document.getElementById('orders');

if (orders.length === 0) {
  el.innerHTML = '<p class="text-white/60">Belum ada pesanan</p>';
}

orders.forEach(o => {
  el.innerHTML += `
    <div class="bg-white/5 p-4 rounded-xl">
      <p><b>ID:</b> ${o.id}</p>
      <p><b>Tanggal:</b> ${o.date}</p>
      <p><b>Status:</b> <span class="text-cyan-400">${o.status}</span></p>
      <p><b>Total:</b> Rp ${o.total.toLocaleString('id-ID')}</p>
    </div>
  `;
});
</script>
@endpush
