@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Data Jersey</h1>

    <!-- FORM TAMBAH -->
    <div class="mb-4 flex flex-wrap gap-2">
        <input id="nama" placeholder="Nama" class="border p-2 rounded">
        <input id="kategori" placeholder="Kategori" class="border p-2 rounded">
        <input id="harga" type="number" placeholder="Harga" class="border p-2 rounded">
        <input id="stok" type="number" placeholder="Stok" class="border p-2 rounded">
        <input id="ukuran" placeholder="Ukuran" class="border p-2 rounded">

        <button onclick="addJersey()"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah
        </button>
    </div>

    <!-- TABLE -->
    <table class="w-full border">
        <thead class="bg-blue-600">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Ukuran</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="list"></tbody>
    </table>
</div>

<script>
const token = localStorage.getItem('token');
if (!token) {
    location.href = '/login';
}

const api = '/api/jerseys';

function authHeaders() {
    return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + token
    };
}

// LOAD DATA
function loadJersey() {
    fetch(api)
        .then(res => res.json())
        .then(res => {
            list.innerHTML = '';
            res.data.forEach(j => {
                list.innerHTML += `
                <tr>
                    <td class="border p-2">${j.nama}</td>
                    <td class="border p-2">${j.kategori}</td>
                    <td class="border p-2">${j.harga}</td>
                    <td class="border p-2">${j.stok}</td>
                    <td class="border p-2">${j.ukuran}</td>
                    <td class="border p-2 text-center">
                        <button onclick="deleteJersey(${j.id})"
                            class="bg-red-600 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </td>
                </tr>
                `;
            });
        });
}

// TAMBAH
function addJersey() {
    fetch(api, {
        method: 'POST',
        headers: authHeaders(),
        body: JSON.stringify({
            nama: nama.value,
            kategori: kategori.value,
            harga: harga.value,
            stok: stok.value,
            ukuran: ukuran.value
        })
    })
    .then(res => res.json())
    .then(() => {
        nama.value = '';
        kategori.value = '';
        harga.value = '';
        stok.value = '';
        ukuran.value = '';
        loadJersey();
    });
}

// DELETE
function deleteJersey(id) {
    if (!confirm('Hapus data ini?')) return;

    fetch(`${api}/${id}`, {
        method: 'DELETE',
        headers: authHeaders()
    })
    .then(() => loadJersey());
}

// LOAD AWAL
loadJersey();
</script>
@endsection
