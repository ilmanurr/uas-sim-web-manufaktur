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
        Schema::create('ketersediaans', function (Blueprint $table) {
            $table->id('id_ketersediaan');
            $table->unsignedBigInteger('id_bahanbaku');
            $table->integer('jml_pesanan');
            $table->integer('jml_persediaan');
            $table->integer('jml_ygdibutuhkan');
            $table->integer('jml_tersisa');
            $table->string('nm_pemesan');
            $table->timestamps();

            $table->foreign('id_bahanbaku')->references('id_bahanbaku')->on('bahan_bakus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketersediaans');
    }
};