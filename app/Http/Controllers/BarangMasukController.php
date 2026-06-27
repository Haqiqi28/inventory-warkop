<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangSisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($validated) {

            BarangMasuk::create([
                'kodebrg'       => $validated['kodebrg'],
                'jumlah_masuk'  => $validated['jumlah_masuk'],
                'satuan'        => $validated['satuan'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'diinput_oleh'  => Auth::user()->username,
                'created_at'    => now(),
            ]);

            $this->updateStokMasuk(
                $validated['kodebrg'],
                $validated['jumlah_masuk'],
                $validated['satuan'],
                $validated['tanggal_masuk']
            );

        });

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

        DB::transaction(function () use ($barangMasuk, $validated) {

            $this->rollbackStokMasuk(
                $barangMasuk->kodebrg,
                $barangMasuk->jumlah_masuk
            );

            $barangMasuk->update([
                'kodebrg'       => $validated['kodebrg'],
                'jumlah_masuk'  => $validated['jumlah_masuk'],
                'satuan'        => $validated['satuan'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'diinput_oleh'  => Auth::user()->username,
            ]);

            $this->updateStokMasuk(
                $validated['kodebrg'],
                $validated['jumlah_masuk'],
                $validated['satuan'],
                $validated['tanggal_masuk']
            );

        });

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

        DB::transaction(function () use ($barangMasuk) {

            $this->rollbackStokMasuk(
                $barangMasuk->kodebrg,
                $barangMasuk->jumlah_masuk
            );

            $barangMasuk->delete();

        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil dihapus.');
    }
    private function updateStokMasuk(
        string $kodebrg,
        int $jumlahMasuk,
        string $satuan,
        string $tanggal
    ): void {

        $stok = BarangSisa::firstOrNew([
            'kodebrg' => $kodebrg,
        ]);

        $stok->stok_tersisa = ($stok->stok_tersisa ?? 0) + $jumlahMasuk;
        $stok->satuan = $satuan;
        $stok->tanggal = $tanggal;

        $stok->save();
    }
    private function rollbackStokMasuk(
        string $kodebrg,
        int $jumlahMasuk
    ): void {

        $stok = BarangSisa::where('kodebrg', $kodebrg)->first();

        if (!$stok) {
            return;
        }

        $stok->stok_tersisa -= $jumlahMasuk;

        if ($stok->stok_tersisa < 0) {
            $stok->stok_tersisa = 0;
        }

        $stok->save();
    }
}