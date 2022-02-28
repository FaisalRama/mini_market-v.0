<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'detail_pembelian';
    protected $fillable = ['pembelian_id', 
                            'barang_id',
                            'harga_beli',
                            'jumlah',
                            'sub_total'];
}
