<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('analisis_profitabilitas', function (Blueprint $table) {
            $table->id('id_analisis');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->enum('tipe_periode', ['harian', 'mingguan', 'bulanan', 'tahunan']);

            $table->decimal('pendapatan_telur', 15, 2)->default(0);
            $table->decimal('pendapatan_ayam', 15, 2)->default(0);
            $table->decimal('pendapatan_lainnya', 15, 2)->default(0);
            $table->decimal('total_pendapatan', 15, 2);

            $table->decimal('biaya_pakan', 15, 2)->default(0);
            $table->decimal('biaya_obat_vitamin', 15, 2)->default(0);
            $table->decimal('biaya_perawatan', 15, 2)->default(0);
            $table->decimal('biaya_gaji', 15, 2)->default(0);
            $table->decimal('biaya_utilitas', 15, 2)->default(0);
            $table->decimal('biaya_lainnya', 15, 2)->default(0);
            $table->decimal('total_pengeluaran', 15, 2);

            $table->decimal('laba_kotor', 15, 2);
            $table->decimal('laba_bersih', 15, 2);
            $table->decimal('margin_laba_persen', 5, 2)->nullable();
            $table->decimal('profitabilitas_persen', 5, 2);
            $table->decimal('roi_persen', 5, 2)->nullable();

            $table->integer('total_produksi_telur')->default(0);
            $table->integer('total_penjualan_telur')->default(0);
            $table->integer('total_penjualan_ayam')->default(0);
            $table->integer('jumlah_ayam_awal')->nullable();
            $table->integer('jumlah_ayam_akhir')->nullable();

            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['periode_mulai', 'periode_selesai']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('analisis_profitabilitas');
    }
};
