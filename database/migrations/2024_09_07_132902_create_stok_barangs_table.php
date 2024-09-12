<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('stok_barangs', function (Blueprint $table) {
            $table->id(); // ID sebagai primary key
            $table->string('kode_produk'); // Pastikan tipe data string, sesuai dengan `produk.kode`
            $table->foreign('kode_produk')->references('kode')->on('produks')->onDelete('cascade'); // Foreign key ke kode di tabel produk
            $table->foreignId('id_stok_opname')->constrained('stok_opnames'); // Foreign key ke tabel stok_opname
            $table->integer('kuantitas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_barangs');
    }
}
