<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    
    public $incrementing = true;
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 
                            'produk_id', 
                            'nama_barang', 
                            'satuan', 
                            'harga_jual', 
                            'stok',
                            'ditarik'];
}
