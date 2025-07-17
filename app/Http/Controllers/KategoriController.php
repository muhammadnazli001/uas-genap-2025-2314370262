<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
{
    $kategori = Kategori::all();
    return view('kategori.index', compact('kategori'));
}
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
{
    $request->validate(['name' => 'required']);
    Kategori::create($request->only('name'));
    return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
}

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['name' => 'required']);
        $kategori->update($request->only('name'));
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }
    
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
