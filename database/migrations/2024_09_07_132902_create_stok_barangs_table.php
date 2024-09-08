<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('stok_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produks')->onDelete('cascade');
            $table->foreignId('id_gudang')->constrained('gudangs')->onDelete('cascade');
            $table->integer('kuantitas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_barangs');
    }
}
