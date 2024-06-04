<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesans', function (Blueprint $table) {
            $table->id('id_pemesan');
            $table->unsignedBigInteger('id_ketersediaan');
            $table->string('nm_pemesan');
            $table->integer('jml_pesanan');
            $table->date('tgl_pemesanan');
            $table->date('tgl_penyelesaian');
            $table->timestamps();

            $table->foreign('id_ketersediaan')->references('id_ketersediaan')->on('ketersediaans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesans');
    }
};