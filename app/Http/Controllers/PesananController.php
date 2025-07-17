<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PesananController extends Controller
{

    public function checkout($produkId)
{
    $produk = Produk::findOrFail($produkId);
    return view('pesanan.checkout', compact('produk'));
}


public function store(Request $request)
{
    $request->validate([
        'produk_id' => 'required|exists:produks,id',
        'size' => 'required',
        'kuantitas' => 'required|integer|min:1',
        'nama_penerima' => 'required',
        'negara' => 'required',
        'provinsi' => 'required',
        'kota' => 'required',
        'nama_jalan' => 'required',
        'kode_pos' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
    ]);

    $produk = Produk::findOrFail($request->produk_id);
    $totalHarga = $produk->price * $request->kuantitas;

    // Simpan ke database
    Pesanan::create([
        'user_id' => auth()->id(),
        'produk_id' => $request->produk_id,
        'size' => $request->size,
        'kuantitas' => $request->kuantitas,
        'total_harga' => $totalHarga, // Tambahkan ini
        'nama_penerima' => $request->nama_penerima,
        'negara' => $request->negara,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
        'nama_jalan' => $request->nama_jalan,
        'kode_pos' => $request->kode_pos,
        'pesan' => $request->pesan,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'pembayaran' => 'COD',
        'status' => 'diproses',
    ]);

    return redirect()->route('pesanan.riwayat')->with('success', 'Produk berhasil ditambahkan.');
}

public function riwayat()
{
    $pesanans = Pesanan::with('produk')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('pesanan.riwayat', compact('pesanans'));
}

}
