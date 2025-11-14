<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kandang', function (Blueprint $table) {
            $table->id('id_kandang');
            $table->string('nama_kandang', 50);
            $table->integer('kapasitas');
            $table->enum('jenis_ayam', ['petelur', 'pedaging', 'campuran']);
            $table->enum('status', ['aktif', 'perbaikan', 'nonaktif'])->default('aktif');
            $table->date('tanggal_dibangun')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kandang');
    }
};
