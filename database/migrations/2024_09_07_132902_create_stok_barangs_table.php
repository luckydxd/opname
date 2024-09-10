<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBarangTable extends Migration
{
    public function up()
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id(); // ID sebagai primary key
            $table->string('kode_produk'); // Menggunakan kode_produk untuk relasi
            $table->foreign('kode_produk')->references('kode')->on('produk'); // Foreign key ke kode di tabel produk
            $table->foreignId('id_stok_opname')->constrained('stok_opname'); // Foreign key ke tabel stok_opname
            $table->integer('kuantitas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_barang');
    }
}
