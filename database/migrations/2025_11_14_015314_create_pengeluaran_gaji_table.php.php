<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan');
            $table->integer('periode_bulan');
            $table->integer('periode_tahun');
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('lembur', 15, 2)->default(0);
            $table->decimal('bonus', 15, 2)->default(0);
            $table->decimal('potongan', 15, 2)->default(0);
            $table->decimal('total_gaji', 15, 2);
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status_bayar', ['pending', 'dibayar'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['periode_tahun', 'periode_bulan']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_gaji');
    }
};
