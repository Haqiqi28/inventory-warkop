<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {

            $table->string('kodebrg')->primary();

            $table->string('namabrg');

            $table->string('kategori');

            $table->string('satuan');

            $table->decimal('harga',15,2);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};