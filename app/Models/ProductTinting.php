<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTinting extends Model
{
    use HasFactory;

    protected $table = 'product_tinting';

    // Kolom yang dapat diisi
    protected $fillable = [
        'name',
        'type',
        'weight',
        'stock',
        'sales_price',
        'date'
    ];

    // Jika menggunakan auto-increment pada id
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    // Mengatur tipe data yang tepat
    protected $casts = [
        'stock' => 'integer',
        'sales_price' => 'integer',
        'date' => 'date',
    ];

    // Jika tabel tidak menggunakan timestamps
    public $timestamps = false;

    public static function updateProduct($id, $name, $type, $weight, $stock, $sales_price)
    {
        set_time_limit(6000);

        // Mencari data produk berdasarkan ID
        $data = ProductTinting::find($id);

        // Memastikan data produk ditemukan
        if ($data) {
            $data->name = $name; // Mengupdate nama produk
            $data->type = $type; // Mengupdate jenis produk
            $data->weight = $weight; // Mengupdate berat produk
            $data->stock = $stock; // Mengupdate stok
            $data->sales_price = $sales_price; // Mengupdate harga jual
            $data->date = date('Y-m-d'); // Mengupdate tanggal dengan tanggal sekarang

            // Menyimpan perubahan ke database
            $data->save();
        } else {
            // Jika data tidak ditemukan, tambahkan penanganan error
            throw new \Exception("Data produk tidak ditemukan.");
        }
    }

}
