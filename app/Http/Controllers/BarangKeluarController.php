<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangSisa;
use App\Models\LaporanTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Menampilkan daftar barang keluar.
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::with('barang')
            ->latest('created_at')
            ->paginate(10);

        return view(
            'barang-keluar.index',
            compact('barangKeluar')
        );
    }

    /**
     * Form tambah barang keluar.
     */
    public function create()
    {
        $barang = Barang::orderBy('namabrg')->get();

        return view(
            'barang-keluar.create',
            compact('barang')
        );
    }

    /**
     * Simpan data barang keluar.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kodebrg'        => 'required|exists:barang,kodebrg',
            'jumlah_keluar'  => 'required|integer|min:1',
            'satuan'         => 'required|string|max:50',
            'tanggal_keluar' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {

            BarangKeluar::create([
                'kodebrg'        => $validated['kodebrg'],
                'jumlah_keluar'  => $validated['jumlah_keluar'],
                'satuan'         => $validated['satuan'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'diinput_oleh'   => Auth::user()->username,
                'created_at'     => now(),
            ]);

            $this->updateStokKeluar(
                $validated['kodebrg'],
                $validated['jumlah_keluar'],
                $validated['satuan'],
                $validated['tanggal_keluar']
            );

            $this->updateLaporanKeluar(
                $validated['kodebrg'],
                $validated['jumlah_keluar'],
                $validated['satuan'],
                $validated['tanggal_keluar'],
                Auth::user()->username
            );

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil ditambahkan.');
    }

    /**
     * Form edit barang keluar.
     */
    public function edit(int $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::orderBy('namabrg')->get();

        return view(
            'barang-keluar.edit',
            compact(
                'barangKeluar',
                'barang'
            )
        );
    }

    /**
     * Update data barang keluar.
     */
    public function update(Request $request, int $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $validated = $request->validate([
            'kodebrg'        => 'required|exists:barang,kodebrg',
            'jumlah_keluar'  => 'required|integer|min:1',
            'satuan'         => 'required|string|max:50',
            'tanggal_keluar' => 'required|date',
        ]);

        DB::transaction(function () use ($barangKeluar, $validated) {

            $this->rollbackStokKeluar(
                $barangKeluar->kodebrg,
                $barangKeluar->jumlah_keluar
            );
            $this->rollbackLaporanKeluar(
                $barangKeluar->kodebrg,
                $barangKeluar->jumlah_keluar,
                $barangKeluar->tanggal_keluar->format('Y-m-d')
            );

            $barangKeluar->update([
                'kodebrg'        => $validated['kodebrg'],
                'jumlah_keluar'  => $validated['jumlah_keluar'],
                'satuan'         => $validated['satuan'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'diinput_oleh'   => Auth::user()->username,
            ]);

            $this->updateStokKeluar(
                $validated['kodebrg'],
                $validated['jumlah_keluar'],
                $validated['satuan'],
                $validated['tanggal_keluar']
            );

            $this->updateLaporanKeluar(
                $validated['kodebrg'],
                $validated['jumlah_keluar'],
                $validated['satuan'],
                $validated['tanggal_keluar'],
                Auth::user()->username
            );

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    /**
     * Hapus data barang keluar.
     */
    public function destroy(int $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        DB::transaction(function () use ($barangKeluar) {

            $this->rollbackStokKeluar(
                $barangKeluar->kodebrg,
                $barangKeluar->jumlah_keluar
            );

            $this->rollbackLaporanKeluar(
                $barangKeluar->kodebrg,
                $barangKeluar->jumlah_keluar,
                $barangKeluar->tanggal_keluar->format('Y-m-d')
            );

            $barangKeluar->delete();

        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus.');
    }
    private function updateStokKeluar(
        string $kodebrg,
        int $jumlahKeluar,
        string $satuan,
        string $tanggal
    ): void {

        $stok = BarangSisa::firstOrNew([
            'kodebrg' => $kodebrg,
        ]);

        $stok->stok_tersisa = ($stok->stok_tersisa ?? 0) - $jumlahKeluar;

        if ($stok->stok_tersisa < 0) {
            $stok->stok_tersisa = 0;
        }

        $stok->satuan = $satuan;
        $stok->tanggal = $tanggal;

        $stok->save();
    }
    private function rollbackStokKeluar(
        string $kodebrg,
        int $jumlahKeluar
    ): void {

        $stok = BarangSisa::where('kodebrg', $kodebrg)->first();

        if (!$stok) {
            return;
        }

        $stok->stok_tersisa += $jumlahKeluar;

        $stok->save();
    }
    private function updateLaporanKeluar(
        string $kodebrg,
        int $jumlahKeluar,
        string $satuan,
        string $tanggal,
        string $diinputOleh
    ): void {

        $laporan = LaporanTransaksi::firstOrNew([
            'kodebrg' => $kodebrg,
            'tanggal' => $tanggal,
        ]);

        $laporan->keluar = ($laporan->keluar ?? 0) + $jumlahKeluar;

        $stok = BarangSisa::where('kodebrg', $kodebrg)->first();

        $laporan->sisa = $stok?->stok_tersisa ?? 0;

        $laporan->masuk = $laporan->masuk ?? 0;

        $laporan->satuan = $satuan;

        $laporan->diinput_oleh = $diinputOleh;

        $laporan->created_at ??= now();

        $laporan->save();
    }
    private function rollbackLaporanKeluar(
        string $kodebrg,
        int $jumlahKeluar,
        string $tanggal
    ): void {

        $laporan = LaporanTransaksi::where([
            'kodebrg' => $kodebrg,
            'tanggal' => $tanggal,
        ])->first();

        if (!$laporan) {
            return;
        }

        $laporan->keluar -= $jumlahKeluar;

        if ($laporan->keluar < 0) {
            $laporan->keluar = 0;
        }

        $stok = BarangSisa::where('kodebrg', $kodebrg)->first();

        $laporan->sisa = $stok?->stok_tersisa ?? 0;

        if (
            $laporan->masuk == 0 &&
            $laporan->keluar == 0
        ) {
            $laporan->delete();
            return;
        }

        $laporan->save();
    }
}