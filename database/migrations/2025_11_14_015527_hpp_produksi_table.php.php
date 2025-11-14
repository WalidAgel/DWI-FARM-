<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hpp_produksi', function (Blueprint $table) {
            $table->id('id_hpp');
            $table->integer('periode_bulan');
            $table->integer('periode_tahun');
            $table->decimal('hpp_telur_per_butir', 10, 2)->nullable();
            $table->decimal('hpp_ayam_per_kg', 10, 2)->nullable();
            $table->decimal('total_biaya_produksi', 15, 2)->nullable();
            $table->integer('total_unit_produksi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['periode_bulan', 'periode_tahun']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hpp_produksi');
    }
};
