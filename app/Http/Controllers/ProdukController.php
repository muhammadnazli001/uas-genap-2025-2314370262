<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->latest()->get();
        $kategori = Kategori::all();
        return view('produk.index', compact('produk', 'kategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
           'size'          => 'nullable|array',
            'size.*'        => 'in:S,M,L,XL,XXL',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric',
            'kategoris_id'  => 'required|exists:kategoris,id',
            'is_publish'    => 'nullable|boolean',
            'published_at'  => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;
        $data['size'] = $request->has('size') ? json_encode($request->size) : null;

         // Simpan foto ke storage
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/foto_produk', $filename); // disimpan ke storage/app/public/foto_produk
        $data['foto'] = 'storage/foto_produk/' . $filename; // untuk diakses lewat URL
    }

        // Set waktu publikasi jika dipublish dan belum ada tanggal
        if ($data['is_publish'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        if (request()->ajax()) {
            return response()->json($produk);
        }

        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'size' => 'nullable|array',
'size.*' => 'in:S,M,L,XL,XXL',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric',
            'kategoris_id'  => 'required|exists:kategoris,id',
            'is_publish'    => 'nullable|boolean',
            'published_at'  => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_publish'] = $request->input('is_publish') == "1" ? 1 : 0;
        $data['size'] = $request->has('size') ? json_encode($request->size) : null;

         // Simpan foto baru dan hapus yang lama
    if ($request->hasFile('foto')) {
        if ($produk->foto && file_exists(public_path($produk->foto))) {
            unlink(public_path($produk->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/foto_produk', $filename);
        $data['foto'] = 'storage/foto_produk/' . $filename;
    }
        if ($data['is_publish'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        // Hapus foto dari server jika ada
        if ($produk->foto && file_exists(public_path($produk->foto))) {
            unlink(public_path($produk->foto));
        }

        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
    public function daftar()
    {
        $produks = Produk::where('is_publish', 1)->latest()->get();
    return view('produk.daftar', compact('produks'));
    }
    public function show(Produk $produk)
{
    return view('produk.show', compact('produk'));
}

}
