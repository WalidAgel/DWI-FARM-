<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran_lainnya', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->foreignId('id_kategori')->nullable()->constrained('kategori_pengeluaran', 'id_kategori');
            $table->date('tanggal');
            $table->string('deskripsi', 200);
            $table->decimal('biaya', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran_lainnya');
    }
};
