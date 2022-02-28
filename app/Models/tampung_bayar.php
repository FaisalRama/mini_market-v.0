<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tampung_bayar extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'tampung_bayar';
    protected $fillable = ['penjualan_id',
                            'total',
                            'terima',
                            'kembali'];
}
