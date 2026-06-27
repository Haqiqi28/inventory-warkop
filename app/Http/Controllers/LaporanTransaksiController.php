<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\LaporanTransaksi;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    /**
     * Menampilkan laporan transaksi.
     */
    public function index(Request $request)
    {
        $query = LaporanTransaksi::with('barang')
            ->latest('tanggal');

        if ($request->filled('kodebrg')) {
            $query->where('kodebrg', $request->kodebrg);
        }

        if ($request->filled('tanggal_awal')) {
            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_awal
            );
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_akhir
            );
        }

        $laporan = $query->paginate(10)
            ->withQueryString();

        $barang = Barang::orderBy('namabrg')->get();

        return view(
            'laporan.index',
            compact(
                'laporan',
                'barang'
            )
        );
    }
}