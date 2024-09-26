<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStokOpnamesTable extends Migration
{
    public function up()
    {
        Schema::create('detail_stok_opnames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_stok_opname')->constrained('stok_opnames')->onDelete('cascade');
            $table->string('kode_produk');
            $table->foreign('kode_produk')->references('kode')->on('produks')->onDelete('cascade');
            $table->integer('kuantitas');
            $table->integer('fisik_all');
            $table->integer('selisih');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_stok_opnames');
    }
}
