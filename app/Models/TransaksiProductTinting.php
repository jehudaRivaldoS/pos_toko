<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProductTinting extends Model
{
    use HasFactory;

    protected $table = 'transaction_product_tinting';

    // Kolom yang dapat diisi
    protected $fillable = [
        'product_tinting_id',
        'qty',
        'colour',
        'seller_price_fix',
        'price',
        'profit',
        'date',
    ];

    // Jika menggunakan auto-increment pada id
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Mengatur tipe data yang tepat
    protected $casts = [
        'product_tinting_id' => 'integer',
        'qty' => 'integer',
        'seller_price_fix' => 'decimal:2',
        'price' => 'decimal:2',
        'profit' => 'decimal:2',
        'date'=> 'date',
    ];

    // Jika ada timestamp (created_at dan updated_at) di tabel, aktifkan ini
    public $timestamps = false;    
}
