<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_transaksi_outlet', function (Blueprint $table) {

            $table->id();

            $table->string('kodebrg');

            $table->integer('masuk')->default(0);

            $table->integer('keluar')->default(0);

            $table->integer('sisa')->default(0);

            $table->string('satuan');

            $table->date('tanggal');

            $table->string('diinput_oleh');

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('kodebrg')
                ->references('kodebrg')
                ->on('barang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_transaksi_outlet');
    }
};