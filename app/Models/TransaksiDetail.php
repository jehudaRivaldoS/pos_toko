<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'transaction_details';
    public $timestamps = false;

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'products_id',
        'qty',
        'seller_price_fix',
        'price',
        'total_price',
        'untung',
        'transaction_headers_id'
    ];

    /**
     * Relasi ke model `Product`
     * Setiap detail transaksi berhubungan dengan satu produk
     */
    public function product()
    {
        return $this->belongsTo(Barang::class, 'products_id');
    }

    /**
     * Relasi ke model `Transaksi`
     * Setiap detail transaksi berhubungan dengan satu transaksi header
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_headers_id');
    }
}
