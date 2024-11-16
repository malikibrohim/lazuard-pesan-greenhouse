<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'nama_produk',
        'kategori_produk',
        'stok_produk',
        'harga_produk',
        'image_produk',
        'deskripsi_produk',
    ];
}
