<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
