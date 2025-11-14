<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_ayam', function (Blueprint $table) {
            $table->id('id_stok');
            $table->foreignId('id_kandang')->constrained('kandang', 'id_kandang');
            $table->date('tanggal');
            $table->integer('jumlah_ayam');
            $table->enum('jenis_ayam', ['petelur', 'pedaging']);
            $table->integer('umur_minggu')->nullable();
            $table->enum('status', ['sehat', 'sakit', 'mati'])->default('sehat');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_ayam');
    }
};
