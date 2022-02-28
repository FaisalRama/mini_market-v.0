<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'produk';
    protected $fillable = ['nama_produk'];
}
