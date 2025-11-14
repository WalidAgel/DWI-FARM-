<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_perawatan', function (Blueprint $table) {
            $table->id('id_perawatan');
            $table->foreignId('id_kandang')->nullable()->constrained('kandang', 'id_kandang');
            $table->date('tanggal_perawatan');
            $table->enum('jenis_perawatan', ['perbaikan', 'pembersihan', 'renovasi', 'peralatan']);
            $table->text('deskripsi');
            $table->decimal('biaya', 15, 2);
            $table->string('penanggung_jawab', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_perawatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_perawatan');
    }
};
