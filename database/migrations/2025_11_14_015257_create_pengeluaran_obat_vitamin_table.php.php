<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_obat_vitamin', function (Blueprint $table) {
            $table->id('id_obat');
            $table->foreignId('id_supplier')->nullable()->constrained('supplier', 'id_supplier');
            $table->date('tanggal_pembelian');
            $table->string('nama_produk', 100);
            $table->enum('jenis', ['obat', 'vitamin', 'vaksin']);
            $table->integer('jumlah');
            $table->string('satuan', 20);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_biaya', 15, 2);
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('tanggal_pembelian');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_obat_vitamin');
    }
};
