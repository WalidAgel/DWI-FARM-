<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('target_keuangan', function (Blueprint $table) {
            $table->id('id_target');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('target_pendapatan', 15, 2);
            $table->decimal('target_pengeluaran', 15, 2);
            $table->decimal('target_laba', 15, 2);
            $table->decimal('target_profitabilitas_persen', 5, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['bulan', 'tahun']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('target_keuangan');
    }
};
