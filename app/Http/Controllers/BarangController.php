<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);

        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'=>'required|max:255',
            'satuan'=>'required'
        ]);

        Barang::create([
            'nama_barang'=>$request->nama_barang,
            'satuan'=>$request->satuan,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success','Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit',compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang'=>'required|max:255',
            'satuan'=>'required'
        ]);

        $barang->update([
            'nama_barang'=>$request->nama_barang,
            'satuan'=>$request->satuan,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success','Barang berhasil diubah.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success','Barang berhasil dihapus.');
    }
}