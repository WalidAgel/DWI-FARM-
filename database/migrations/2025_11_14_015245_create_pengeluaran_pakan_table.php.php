<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_pakan', function (Blueprint $table) {
            $table->id('id_pakan');
            $table->foreignId('id_supplier')->nullable()->constrained('supplier', 'id_supplier');
            $table->date('tanggal_pembelian');
            $table->string('jenis_pakan', 100);
            $table->decimal('jumlah_kg', 10, 2);
            $table->decimal('harga_per_kg', 15, 2);
            $table->decimal('total_biaya', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_pembelian');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_pakan');
    }
};
