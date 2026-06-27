<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $primaryKey = 'kodebrg';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kodebrg',
        'namabrg',
        'kategori',
        'satuan',
        'harga',
    ];


    public function barangMasuk()
    {
        return $this->hasMany(
            BarangMasuk::class,
            'kodebrg',
            'kodebrg'
        );
    }

    public function barangKeluar()
    {
        return $this->hasMany(
            BarangKeluar::class,
            'kodebrg',
            'kodebrg'
        );
    }
    public function barangSisa()
    {
        return $this->hasOne(
            BarangSisa::class,
            'kodebrg',
            'kodebrg'
        );
    }

    public function stokOutlet()
    {
        return $this->hasMany(
            StokOutlet::class,
            'kodebrg',
            'kodebrg'
        );
    }

}