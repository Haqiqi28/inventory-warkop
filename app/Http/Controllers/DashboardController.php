<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Outlet;
use App\Models\StokOutlet;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalBarang = Barang::count();

        $barangMasukHariIni = BarangMasuk::whereDate(
            'tanggal',
            today()
        )->count();

        $barangKeluarHariIni = BarangKeluar::whereDate(
            'tanggal',
            today()
        )->count();

        $stokMenipis = StokOutlet::where('stok','<=',10)
                        ->count();

        $transaksiTerbaru = BarangMasuk::with([
                'barang',
                'outlet'
            ])
            ->latest()
            ->take(5)
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

        $totalOutlet = Outlet::count();

        $barangMasuk = BarangMasuk::count();

        $barangKeluar = BarangKeluar::count();

        $stok = StokOutlet::with([
            'barang',
            'outlet'
        ])
        ->get();

        return view(
            'dashboard.master',
            compact(
                'totalBarang',
                'totalOutlet',
                'barangMasuk',
                'barangKeluar',
                'stok'
            )
        );
    }
}