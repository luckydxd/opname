<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode'];

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class);
    }

    public function detailStokOpnames()
    {
        return $this->hasMany(DetailStokOpname::class);
    }
}
