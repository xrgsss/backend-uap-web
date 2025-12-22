document.addEventListener("DOMContentLoaded", () => {
  const produkContainer = document.getElementById("produk-container");
  const unggulanContainer = document.getElementById("unggulan-container");
  const cartContainer = document.getElementById("cart-container");

  const DATA_URL = "/data.json";
  let PRODUCTS = [];
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // ==========================
  // AMBIL DATA PRODUK
  // ==========================
  fetch(DATA_URL)
    .then(res => res.json())
    .then(data => {
      PRODUCTS = data;

      if (produkContainer) {
        renderProduk(produkContainer, PRODUCTS);
      }

      if (unggulanContainer) {
        renderProduk(unggulanContainer, PRODUCTS.slice(0, 3));
      }
    })
    .catch(err => console.error("Gagal mengambil data:", err));

  // ==========================
  // RENDER PRODUK
  // ==========================
  function renderProduk(container, data) {
    container.innerHTML = data
      .map(
        (p, i) => `
        <div class="produk-card">
          <img src="${p.gambar}" alt="${p.nama}">
          <h4>${p.nama}</h4>
          <p class="harga">Rp ${Number(p.harga).toLocaleString("id-ID")}</p>
          <button onclick="tambahKeranjang(${p.id})">
            Tambah ke Keranjang
          </button>
        </div>
      `
      )
      .join("");
  }

  // ==========================
  // TAMBAH KE KERANJANG
  // ==========================
  window.tambahKeranjang = (id) => {
    const produk = PRODUCTS.find(p => p.id === id);
    if (!produk) return;

    const item = cart.find(c => c.id === id);

    if (item) {
      item.qty += 1;
    } else {
      cart.push({
        id: produk.id,
        nama: produk.nama,
        harga: Number(produk.harga),
        gambar: produk.gambar,
        qty: 1
      });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert(`${produk.nama} ditambahkan ke keranjang`);
  };

  // ==========================
  // RENDER KERANJANG
  // ==========================
  if (cartContainer) {
    renderKeranjang();
  }

  function renderKeranjang() {
    if (cart.length === 0) {
      cartContainer.innerHTML = "<p>Keranjang masih kosong.</p>";
      return;
    }

    let total = 0;

    cartContainer.innerHTML = cart
      .map((item, i) => {
        const subtotal = item.harga * item.qty;
        total += subtotal;

        return `
          <div class="cart-item">
            <img src="${item.gambar}" alt="${item.nama}">
            <div>
              <h4>${item.nama}</h4>
              <p>Qty: ${item.qty}</p>
              <p>Rp ${subtotal.toLocaleString("id-ID")}</p>
            </div>
            <button onclick="hapusKeranjang(${i})">Hapus</button>
          </div>
        `;
      })
      .join("");

    cartContainer.innerHTML += `
      <h3>Total: Rp ${total.toLocaleString("id-ID")}</h3>
    `;
  }

  // ==========================
  // HAPUS DARI KERANJANG
  // ==========================
  window.hapusKeranjang = (index) => {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderKeranjang();
  };
});
