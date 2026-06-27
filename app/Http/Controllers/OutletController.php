<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\StokOutlet;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function pilih()
    {
        $outlets = Outlet::orderBy('nama')->get();

        return view(
            'outlet.pilih',
            compact('outlets')
        );
    }
    public function laporan(Outlet $outlet)
    {
        $barangMasuk = BarangMasuk::with('barang')
            ->where('outlet_id',$outlet->id)
            ->get();

        $barangKeluar = BarangKeluar::with('barang')
            ->where('outlet_id',$outlet->id)
            ->get();

        $stok = StokOutlet::with('barang')
            ->where('outlet_id',$outlet->id)
            ->get();

        return view(
            'laporan.outlet',
            compact(
                'outlet',
                'barangMasuk',
                'barangKeluar',
                'stok'
            )
        );
    }
    public function gabungan()
    {
        $laporan = StokOutlet::with([
            'barang',
            'outlet'
        ])
        ->orderBy('outlet_id')
        ->get();

        return view(
            'laporan.gabungan',
            compact('laporan')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outlet $outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outlet $outlet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        //
    }
}
