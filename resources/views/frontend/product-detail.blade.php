@extends('layouts.app')
@section('title','Detail Produk')

@section('content')
<div class="grid md:grid-cols-2 gap-12" id="detail"></div>
@endsection

@push('scripts')
<script src="/products.js"></script>
<script>
const product = PRODUCTS.find(p => p.id == {{ $id }});
const el = document.getElementById('detail');

el.innerHTML = `
  <img src="${product.image}" class="rounded-xl">
  <div>
    <h1 class="text-3xl font-bold">${product.name}</h1>
    <p class="text-cyan-400 text-xl mt-2">Rp ${product.price.toLocaleString()}</p>

    <button onclick="addToCart()" class="mt-6 bg-cyan-500 px-6 py-3 rounded-lg">
      Add to Cart
    </button>
  </div>
`;

function addToCart() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  cart.push({ ...product, qty: 1 });
  localStorage.setItem('cart', JSON.stringify(cart));
  alert('Produk ditambahkan ke keranjang');
}
</script>
@endpush
