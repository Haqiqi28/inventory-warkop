<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Outlet;
use App\Models\StokOutlet;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuks = BarangMasuk::with([
            'barang',
            'outlet'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'barang_masuk.index',
            compact('barangMasuks')
        );
    }

    public function create()
    {
        return view('barang_masuk.create',[
            'barangs'=>Barang::orderBy('nama_barang')->get(),
            'outlets'=>Outlet::orderBy('nama')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'=>'required',
            'outlet_id'=>'required',
            'jumlah'=>'required|integer|min:1',
            'tanggal'=>'required|date'
        ]);

        BarangMasuk::create($request->all());

        // Update stok outlet

        $stok = StokOutlet::firstOrCreate(
            [
                'barang_id'=>$request->barang_id,
                'outlet_id'=>$request->outlet_id
            ],
            [
                'stok'=>0
            ]
        );

        $stok->increment('stok',$request->jumlah);

        return redirect()
                ->route('barang-masuk.index')
                ->with('success','Barang masuk berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
    }
}
