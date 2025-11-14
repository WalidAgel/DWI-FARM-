<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produksi_telur', function (Blueprint $table) {
            $table->id('id_produksi');
            $table->foreignId('id_kandang')->constrained('kandang', 'id_kandang');
            $table->date('tanggal_produksi');
            $table->integer('jumlah_telur');
            $table->integer('jumlah_pecah')->default(0);
            $table->integer('jumlah_layak_jual');
            $table->decimal('berat_rata_rata', 5, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_produksi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produksi_telur');
    }
};

