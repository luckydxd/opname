<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;
    protected $table = 'stok_opnames';

    protected $fillable = ['nomor_dokumen', 'id_gudang', 'tanggal_opname'];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    public function detailStokOpnames()
    {
        return $this->hasMany(DetailStokOpname::class, 'id_stok_opname');
    }
    public function stokBarangs()
    {
        return $this->hasMany(StokBarang::class, 'id_stok_opname');
    }
    
}
