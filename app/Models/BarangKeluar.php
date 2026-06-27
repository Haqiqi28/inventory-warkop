<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar_outlet';

    public $timestamps = false;

    protected $fillable = [
        'kodebrg',
        'jumlah_keluar',
        'satuan',
        'tanggal_keluar',
        'diinput_oleh',
        'created_at',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
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