<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStokOpname extends Model
{
    use HasFactory;

    protected $fillable = ['id_stok_opname', 'kode_produk', 'kuantitas', 'fisik_all', 'selisih', 'keterangan'];

    public function stokOpname()
    {
        return $this->belongsTo(StokOpname::class, 'id_stok_opname');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode');
    }
}
