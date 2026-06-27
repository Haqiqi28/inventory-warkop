<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Outlet;
use App\Models\StokOutlet;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangKeluars = BarangKeluar::with([
            'barang',
            'outlet'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'barang_keluar.index',
            compact('barangKeluars')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang_keluar.create',[
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

        $stok = StokOutlet::where('barang_id',$request->barang_id)
            ->where('outlet_id',$request->outlet_id)
            ->first();

        if(!$stok || $stok->stok < $request->jumlah){

            return back()
                ->withInput()
                ->with('error','Stok tidak mencukupi.');

        }

        BarangKeluar::create($request->all());

        $stok->decrement('stok',$request->jumlah);

        return redirect()
                ->route('barang-keluar.index')
                ->with('success','Barang keluar berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }
}
