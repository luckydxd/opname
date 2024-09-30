<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokOpnamesTable extends Migration
{
    public function up()
    {
        Schema::create('stok_opnames', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen');
            $table->foreignId('id_gudang')->constrained('gudangs')->onDelete('cascade');
            $table->date('tanggal_opname');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_opnames');
    }
}
