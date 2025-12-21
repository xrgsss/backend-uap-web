@extends('layouts.app')
@section('title','Keranjang')

@section('content')
<h1 class="text-3xl font-bold mb-8">Keranjang</h1>
<div id="cart"></div>
@endsection

@push('scripts')
<script>
const cart = JSON.parse(localStorage.getItem('cart')) || [];
const el = document.getElementById('cart');
let total = 0;

cart.forEach(p => {
  total += p.price * p.qty;
  el.innerHTML += `
    <div class="flex justify-between bg-white/5 p-4 rounded-lg mb-3">
      <span>${p.name} (x${p.qty})</span>
      <span>Rp ${(p.price*p.qty).toLocaleString()}</span>
    </div>
  `;
});

el.innerHTML += `<p class="mt-6 text-xl">Total: <b>Rp ${total.toLocaleString()}</b></p>`;
</script>
@endpush
