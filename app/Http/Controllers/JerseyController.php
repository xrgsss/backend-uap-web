<?php

namespace App\Http\Controllers;

use App\Models\Jersey;
use Illuminate\Http\Request;

class JerseyController extends Controller
{
    // GET ALL
    public function index()
    {
        return response()->json(Jersey::all());
    }

    // GET DETAIL
    public function show($id)
    {
        $jersey = Jersey::findOrFail($id);
        return response()->json($jersey);
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string',
            'kategori'  => 'required|string',
            'harga'     => 'required|integer',
            'stok'      => 'required|integer',
            'ukuran'    => 'required|string',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/jerseys', $filename);
            $validated['gambar'] = $filename;
        }

        Jersey::create($validated);

        return response()->json([
            'message' => 'Jersey berhasil ditambahkan'
        ], 201);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $jersey = Jersey::findOrFail($id);

        $data = $request->only([
            'nama','kategori','harga','stok','ukuran','deskripsi'
        ]);

        $jersey->update($data);

        return response()->json([
            'message' => 'Jersey berhasil diperbarui'
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        Jersey::destroy($id);

        return response()->json([
            'message' => 'Jersey berhasil dihapus'
        ]);
    }
}
