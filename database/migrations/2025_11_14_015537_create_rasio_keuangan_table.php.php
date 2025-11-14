<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rasio_keuangan', function (Blueprint $table) {
            $table->id('id_rasio');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('gross_profit_margin', 5, 2)->nullable();
            $table->decimal('net_profit_margin', 5, 2)->nullable();
            $table->decimal('return_on_assets', 5, 2)->nullable();
            $table->decimal('return_on_equity', 5, 2)->nullable();
            $table->decimal('current_ratio', 5, 2)->nullable();
            $table->decimal('cash_ratio', 5, 2)->nullable();
            $table->decimal('biaya_pakan_per_telur', 10, 2)->nullable();
            $table->decimal('biaya_pakan_per_ayam', 10, 2)->nullable();
            $table->decimal('produktivitas_per_kandang', 10, 2)->nullable();
            $table->decimal('break_even_point', 15, 2)->nullable();
            $table->timestamps();

            $table->unique(['bulan', 'tahun']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rasio_keuangan');
    }
};
