let PRODUCTS = [];

fetch("/data.json")
  .then(res => res.json())
  .then(data => {
    PRODUCTS = data;
    document.dispatchEvent(new Event("products-loaded"));
  })
  .catch(err => console.error("Gagal load data produk:", err));
