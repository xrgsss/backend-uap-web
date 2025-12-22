@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {

    // ================= LOGIN CHECK =================
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Silakan login terlebih dahulu');
        window.location.href = '/login';
        return;
    }

    // ================= SAFE GET CART =================
    function getCart() {
        try {
            const data = JSON.parse(localStorage.getItem('cart'));
            return Array.isArray(data) ? data : [];
        } catch (e) {
            console.error('Cart rusak:', e);
            return [];
        }
    }

    const el = document.getElementById('checkout-items');
    const totalEl = document.getElementById('checkout-total');
    const payBtn = document.getElementById('payBtn');

    let cart = getCart();
    let total = 0;

    // ================= RENDER =================
    function renderCheckout() {
        el.innerHTML = '';
        total = 0;

        if (cart.length === 0) {
            el.innerHTML = `
                <p class="text-white/60">
                    Keranjang kosong. Silakan pilih produk terlebih dahulu.
                </p>
            `;
            totalEl.innerText = 'Rp 0';
            payBtn.disabled = true;
            return;
        }

        cart.forEach(item => {
            if (!item.name || !item.price) return;

            total += item.price * item.qty;

            el.innerHTML += `
            <div class="flex justify-between bg-white/5 p-4 rounded-lg">
                <div>
                    <strong>${item.name}</strong><br>
                    <span class="text-sm text-white/60">
                        Ukuran: ${item.size} | Qty: ${item.qty}
                    </span>
                </div>
                <div class="text-cyan-400">
                    Rp ${(item.price * item.qty).toLocaleString('id-ID')}
                </div>
            </div>
            `;
        });

        totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    // ================= ORDER =================
    payBtn.addEventListener('click', () => {
        if (cart.length === 0) return;

        localStorage.setItem('orders', JSON.stringify([
            ...(JSON.parse(localStorage.getItem('orders')) || []),
            {
                id: Date.now(),
                items: cart,
                total,
                status: 'Diproses',
                date: new Date().toLocaleString()
            }
        ]));

        localStorage.removeItem('cart');
        window.location.href = '/checkout-success';
    });

    renderCheckout();
});
</script>
@endpush
