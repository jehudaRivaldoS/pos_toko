<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'cart';
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'products_id',
        'qty',
        'seller_price_fix',
        'price',
        'total_price',
        'untung',
        'user_id',
    ];

    /**
     * Relasi ke model Product
     * Setiap item di cart terkait dengan satu produk
     */
    public function product()
    {
        return $this->belongsTo(Barang::class, 'products_id');
    }
    public function products()
    {
        return $this->belongsTo(Barang::class, 'products_id'); // 'products_id' adalah nama kolom foreign key
    }
}
