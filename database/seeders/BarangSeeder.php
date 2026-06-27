<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::insert([
        [
            'kodebrg'=>'BRG001',
            'namabrg'=>'Gula',
            'kategori'=>'Bahan Baku',
            'satuan'=>'Kg',
            'harga'=>10000
        ],
        [
            'kodebrg'=>'BRG002',
            'namabrg'=>'Susu',
            'kategori'=>'Bahan Baku',
            'satuan'=>'Liter',
            'harga'=>15000
        ],
        [
            'kodebrg'=>'BRG003',
            'namabrg'=>'Kopi',
            'kategori'=>'Bahan Baku',
            'satuan'=>'Kg',
            'harga'=>20000
        ]
    ]);
    }
}
