<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_barang extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'pengajuan_barang';
    protected $fillable = ['nama_pengaju', 
                            'nama_barang', 
                            'tanggal_pengajuan', 
                            'qty' 
                            // 'ditarik'
                        ];
}
