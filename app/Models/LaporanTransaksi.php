<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanTransaksi extends Model
{
    protected $table = 'laporan_transaksi_outlet';

    public $timestamps = false;

    protected $fillable = [
        'kodebrg',
        'masuk',
        'keluar',
        'sisa',
        'satuan',
        'tanggal',
        'diinput_oleh',
        'created_at',
    ];

    protected $casts = [
        'tanggal'   => 'date',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi ke Master Barang
     */
    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'kodebrg',
            'kodebrg'
        );
    }
}