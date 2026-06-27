<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    public function stokOutlets()
    {
        return $this->hasMany(StokOutlet::class);
    }
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
