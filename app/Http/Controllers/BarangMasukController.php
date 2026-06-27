<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar barang masuk.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('barang')
            ->latest('created_at')
            ->paginate(10);

        return view(
            'barang-masuk.index',
            compact('barangMasuk')
        );
    }

    /**
     * Form tambah barang masuk.
     */
    public function create()
    {
        $barang = Barang::orderBy('namabrg')->get();

        return view(
            'barang-masuk.create',
            compact('barang')
        );
    }

    /**
     * Simpan data barang masuk.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kodebrg'       => 'required|exists:barang,kodebrg',
            'jumlah_masuk'  => 'required|integer|min:1',
            'satuan'        => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
        ]);

        BarangMasuk::create([
            'kodebrg'       => $validated['kodebrg'],
            'jumlah_masuk'  => $validated['jumlah_masuk'],
            'satuan'        => $validated['satuan'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'diinput_oleh'  => Auth::user()->name_user,
            'created_at'    => now(),
        ]);

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil ditambahkan.');
    }

    /**
     * Form edit barang masuk.
     */
    public function edit(int $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $barang = Barang::orderBy('namabrg')->get();

        return view(
            'barang-masuk.edit',
            compact(
                'barangMasuk',
                'barang'
            )
        );
    }

    /**
     * Update data barang masuk.
     */
    public function update(Request $request, int $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $validated = $request->validate([
            'kodebrg'       => 'required|exists:barang,kodebrg',
            'jumlah_masuk'  => 'required|integer|min:1',
            'satuan'        => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
        ]);

        $barangMasuk->update([
            'kodebrg'       => $validated['kodebrg'],
            'jumlah_masuk'  => $validated['jumlah_masuk'],
            'satuan'        => $validated['satuan'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'diinput_oleh'  => Auth::user()->name_user,
        ]);

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    /**
     * Hapus data barang masuk.
     */
    public function destroy(int $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $barangMasuk->delete();

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil dihapus.');
    }
}