<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang
     */
    public function index()
    {
        $barang = Barang::orderBy('namabrg')->paginate(10);

        return view('barang.index', compact('barang'));
    }

    /**
     * Form tambah barang
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Simpan barang baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kodebrg'  => 'required|string|max:30|unique:barang,kodebrg',
            'namabrg'  => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'satuan'   => 'required|string|max:50',
            'harga'    => 'required|numeric|min:0',
        ]);

        Barang::create($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    /**
     * Form edit barang
     */
    public function edit(string $kodebrg)
    {
        $barang = Barang::findOrFail($kodebrg);

        return view('barang.edit', compact('barang'));
    }

    /**
     * Update data barang
     */
    public function update(Request $request, string $kodebrg)
    {
        $barang = Barang::findOrFail($kodebrg);

        $validated = $request->validate([
            'kodebrg'  => 'required|string|max:30|unique:barang,kodebrg,' . $barang->kodebrg . ',kodebrg',
            'namabrg'  => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'satuan'   => 'required|string|max:50',
            'harga'    => 'required|numeric|min:0',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil diubah.');
    }

    /**
     * Hapus barang
     */
    public function destroy(string $kodebrg)
    {
        $barang = Barang::findOrFail($kodebrg);

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}