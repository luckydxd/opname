<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barangs';

    protected $fillable = [
        'kode_produk',
        'id_stok_opname',
        'kuantitas',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode');
    }

    public function stokOpname()
    {
        return $this->belongsTo(StokOpname::class, 'id_stok_opname');
    }
}
