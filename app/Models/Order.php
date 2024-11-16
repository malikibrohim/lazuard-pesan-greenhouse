<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'Orders';

    protected $fillable = [
        'no_pemesanan',
        'nama_customer',
        'alamat',
        'no_telp',
        'nama_produk',
        'jumlah',
        'status',
        'total_harga',
    ];
}
