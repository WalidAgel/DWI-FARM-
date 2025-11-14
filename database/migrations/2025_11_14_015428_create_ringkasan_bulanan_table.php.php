<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ringkasan_bulanan', function (Blueprint $table) {
            $table->id('id_ringkasan');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('total_pengeluaran', 15, 2);
            $table->decimal('total_pendapatan', 15, 2);
            $table->decimal('pendapatan_bersih', 15, 2);
            $table->decimal('profitabilitas_persen', 5, 2);
            $table->integer('total_produksi_telur')->nullable();
            $table->integer('total_penjualan_telur')->nullable();
            $table->integer('total_penjualan_ayam')->nullable();
            $table->integer('jumlah_ayam_aktif')->nullable();
            $table->timestamps();

            $table->unique(['bulan', 'tahun']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ringkasan_bulanan');
    }
};
