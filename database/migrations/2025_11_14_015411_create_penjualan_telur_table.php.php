<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualan_telur', function (Blueprint $table) {
            $table->id('id_penjualan_telur');
            $table->foreignId('id_pelanggan')->nullable()->constrained('pelanggan', 'id_pelanggan');
            $table->date('tanggal_penjualan');
            $table->integer('jumlah_telur');
            $table->decimal('harga_per_butir', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'tempo']);
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('lunas');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_penjualan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan_telur');
    }
};
