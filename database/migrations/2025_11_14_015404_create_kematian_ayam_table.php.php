<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kematian_ayam', function (Blueprint $table) {
            $table->id('id_kematian');
            $table->foreignId('id_kandang')->constrained('kandang', 'id_kandang');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('penyebab', 200)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kematian_ayam');
    }
};
