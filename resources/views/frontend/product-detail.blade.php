@extends('layouts.app')

@section('title','Detail Produk')

@section('content')
<div class="grid md:grid-cols-2 gap-12">

    <!-- IMAGE -->
    <div>
        <div class="bg-white rounded-2xl p-1">
            <img id="product-image" class="rounded-xl w-full">
        </div>
    </div>

    <!-- INFO -->
    <div>
        <h1 id="product-name" class="text-3xl font-bold"></h1>
        <p id="product-price" class="text-cyan-400 text-xl mt-2"></p>

        <!-- SIZE -->
        <div class="mt-6">
            <h4 class="font-semibold mb-2">Pilih Ukuran</h4>
            <div class="grid grid-cols-4 gap-3">
                <button class="size-btn" data-size="S">S</button>
                <button class="size-btn" data-size="M">M</button>
                <button class="size-btn" data-size="L">L</button>
                <button class="size-btn" data-size="XL">XL</button>
            </div>
        </div>

        <!-- ADD TO CART -->
        <button id="add-to-cart"
            class="mt-8 w-full bg-white text-cyan-900 py-4 rounded-full text-lg font-semibold">
            Add to Bag
        </button>

        <button id="favorite-btn"
            class="mt-3 w-full border border-white/20 py-3 rounded-full">
            Favorite ♡
        </button>

        <!-- INFO -->
        <div class="mt-10 text-sm text-white/70 space-y-4">
            <div>
                <h4 class="font-semibold">Shipping</h4>
                <p>You’ll see shipping options at checkout.</p>
            </div>

            <div>
                <h4 class="font-semibold">Free Pickup</h4>
                <p class="underline">Find a Store</p>
            </div>

            <div>
                <p id="product-desc"></p>
                <ul class="list-disc ml-5 mt-2">
                    <li id="product-color"></li>
                    <li id="product-style"></li>
                </ul>
            </div>

            <div class="border-t border-white pt-4">
                <strong>Reviews (783)</strong> ★★★★★
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/products.js"></script>

<script>
const PRODUCT_ID = {{ $id }};
let selectedSize = null;
let product = null;

/* ===============================
   TUNGGU DATA DARI FETCH
================================ */
document.addEventListener('products-loaded', () => {

    product = PRODUCTS.find(p => p.id == PRODUCT_ID);

    if (!product) {
        alert('Produk tidak ditemukan');
        return;
    }

    // ===== RENDER =====
    document.getElementById('product-image').src = product.image;
    document.getElementById('product-name').innerText = product.name;
    document.getElementById('product-price').innerText =
        'Rp ' + product.price.toLocaleString('id-ID');

    document.getElementById('product-desc').innerText =
        product.description ?? 'Jersey Persela Lamongan dengan bahan premium.';

    document.getElementById('product-color').innerText =
        'Shown: Biru Persela';

    document.getElementById('product-style').innerText =
        'Style: PRSL-' + product.id;
});

/* ===============================
   SIZE SELECTION
================================ */
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.size-btn')
            .forEach(b => b.classList.remove('active'));

        btn.classList.add('active');
        selectedSize = btn.dataset.size;
    });
});

/* ===============================
   ADD TO CART
================================ */
document.getElementById('add-to-cart').addEventListener('click', () => {

    if (!product) {
        alert('Produk belum siap');
        return;
    }

    if (!selectedSize) {
        alert('Silakan pilih ukuran terlebih dahulu');
        return;
    }

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existing = cart.find(
        item => item.id === product.id && item.size === selectedSize
    );

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            image: product.image,
            size: selectedSize,
            qty: 1
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    console.log('CART:', cart);
    alert('Produk berhasil ditambahkan ke keranjang');
});

/* ===============================
   FAVORITE
================================ */
const favBtn = document.getElementById('favorite-btn');

favBtn.addEventListener('click', () => {
    if (!product) return;

    let fav = JSON.parse(localStorage.getItem('favorite')) || [];
    const exists = fav.find(p => p.id === product.id);

    if (exists) {
        fav = fav.filter(p => p.id !== product.id);
        favBtn.innerText = 'Favorite ♡';
    } else {
        fav.push(product);
        favBtn.innerText = 'Favorited ♥';
    }

    localStorage.setItem('favorite', JSON.stringify(fav));
});
</script>

<style>
.size-btn{
    border:1px solid rgba(255,255,255,.2);
    padding:10px;
    border-radius:8px;
    transition:.2s;
}
.size-btn:hover{
    border-color:#22d3ee;
}
.size-btn.active{
    border-color:#22d3ee;
    background:#22d3ee;
    color:#0f172a;
}
</style>
@endpush
