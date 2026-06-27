<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangSisa extends Model
{
    protected $table = 'barang_sisa_outlet';

    public $timestamps = false;

    protected $fillable = [
        'kodebrg',
        'stok_tersisa',
        'satuan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'kodebrg',
            'kodebrg'
        );
    }
}