<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_utilitas', function (Blueprint $table) {
            $table->id('id_utilitas');
            $table->date('tanggal');
            $table->enum('jenis', ['listrik', 'air', 'transportasi', 'lainnya']);
            $table->string('deskripsi', 200)->nullable();
            $table->decimal('biaya', 15, 2);
            $table->integer('periode_bulan')->nullable();
            $table->integer('periode_tahun')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['periode_tahun', 'periode_bulan']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_utilitas');
    }
};

