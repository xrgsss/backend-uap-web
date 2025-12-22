@extends('layouts.app')
@section('title','Keranjang')

@section('content')
<h1 class="text-3xl font-bold mb-8">Keranjang</h1>

<div id="cart-list" class="space-y-4"></div>

<div class="flex justify-between items-center mt-8 border-t border-white/20 pt-6">
    <h2 class="text-xl">
        Total:
        <span id="cart-total" class="text-cyan-400 font-bold"></span>
    </h2>

    <!-- ✅ CHECKOUT LINK -->
    <a href="/checkout"
       class="bg-cyan-500 px-8 py-3 rounded-full text-black font-semibold">
        Checkout
    </a>
</div>
@endsection

@push('scripts')
<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];
const el = document.getElementById('cart-list');
const totalEl = document.getElementById('cart-total');

function renderCart() {
    el.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
        el.innerHTML = '<p class="text-white/60">Keranjang masih kosong.</p>';
        totalEl.innerText = 'Rp 0';
        return;
    }

    cart.forEach((item, index) => {
        total += item.price * item.qty;

        el.innerHTML += `
        <div class="flex gap-4 items-center bg-white/5 p-4 rounded-xl">
            <img src="${item.image}" class="w-20 h-20 rounded-lg object-cover">

            <div class="flex-1">
                <h3 class="font-semibold">${item.name}</h3>

                <!-- UKURAN -->
                <select onchange="updateSize(${index}, this.value)"
                    class="bg-black/30 border border-white/20 rounded px-2 py-1 mt-1">
                    ${['S','M','L','XL'].map(size => `
                        <option ${item.size === size ? 'selected':''}>${size}</option>
                    `).join('')}
                </select>

                <p class="text-cyan-400 mt-1">
                    Rp ${(item.price * item.qty).toLocaleString('id-ID')}
                </p>
            </div>

            <!-- QTY -->
            <div class="flex items-center gap-2">
                <button onclick="changeQty(${index}, -1)" class="qty-btn">−</button>
                <span>${item.qty}</span>
                <button onclick="changeQty(${index}, 1)" class="qty-btn">+</button>
            </div>

            <!-- HAPUS -->
            <button onclick="removeItem(${index})"
                class="text-red-400 hover:underline ml-4">
                Hapus
            </button>
        </div>
        `;
    });

    totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
    localStorage.setItem('cart', JSON.stringify(cart));
}

function changeQty(index, delta) {
    cart[index].qty += delta;
    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }
    renderCart();
}

function updateSize(index, size) {
    cart[index].size = size;
    localStorage.setItem('cart', JSON.stringify(cart));
}

function removeItem(index) {
    if (confirm('Hapus produk dari keranjang?')) {
        cart.splice(index, 1);
        renderCart();
    }
}

renderCart();
</script>

<style>
.qty-btn{
    width:32px;
    height:32px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,.2);
}
.qty-btn:hover{
    border-color:#22d3ee;
}
</style>
@endpush
