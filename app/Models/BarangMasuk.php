<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk_outlet';

    public $timestamps = false;

    protected $fillable = [
        'kodebrg',
        'jumlah_masuk',
        'satuan',
        'tanggal_masuk',
        'diinput_oleh',
        'created_at',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'created_at' => 'datetime',
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