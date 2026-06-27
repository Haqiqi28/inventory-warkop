<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\BarangSisa;
use App\Models\LaporanTransaksi;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalBarang = Barang::count();

        $barangMasukHariIni = BarangMasuk::whereDate(
            'tanggal_masuk',
            today()
        )->sum('jumlah_masuk');

        $barangKeluarHariIni = BarangKeluar::whereDate(
            'tanggal_keluar',
            today()
        )->sum('jumlah_keluar');

        $stokMenipis = BarangSisa::where(
            'stok_tersisa',
            '<=',
            10
        )->count();

        $transaksiTerbaru = LaporanTransaksi::with('barang')
            ->latest('tanggal')
            ->take(10)
            ->get();

        return view(
            'dashboard.admin',
            compact(
                'totalBarang',
                'barangMasukHariIni',
                'barangKeluarHariIni',
                'stokMenipis',
                'transaksiTerbaru'
            )
        );
    }

    public function master()
    {
        $totalBarang = Barang::count();

        $barangMasuk = BarangMasuk::sum(
            'jumlah_masuk'
        );

        $barangKeluar = BarangKeluar::sum(
            'jumlah_keluar'
        );

        $stok = BarangSisa::with('barang')
            ->orderBy('kodebrg')
            ->get();

        return view(
            'dashboard.master',
            compact(
                'totalBarang',
                'barangMasuk',
                'barangKeluar',
                'stok'
            )
        );
    }
}