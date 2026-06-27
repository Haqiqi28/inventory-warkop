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
        Schema::create('barang_masuk_outlet', function (Blueprint $table) {

            $table->id();

            $table->string('kodebrg');

            $table->integer('jumlah_masuk');

            $table->string('satuan');

            $table->date('tanggal_masuk');

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
        Schema::dropIfExists('barang_masuk_outlet');
    }
};