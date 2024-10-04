<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'stock',
        'unit',
        'price_buy',
        'price_sell_recomendation',
        'supplier_name',
        'supplier_date',
        'location',
    ];

    public static function edits($id, $n, $s, $sa, $hb, $hjr, $sn, $sd, $l)
    {
        set_time_limit(6000);

        // Mencari data barang berdasarkan ID
        $data = Barang::find($id);

        // Memastikan data barang ditemukan
        if ($data) {
            $data->name = $n; // Mengupdate nama barang
            $data->stock = $s; // Mengupdate stok
            $data->unit = $sa; // Mengupdate satuan
            $data->price_buy = $hb; // Mengupdate harga beli
            $data->price_sell_recomendation = $hjr; // Mengupdate harga jual rekomendasi
            $data->supplier_name = $sn; // Mengupdate nama supplier
            $data->supplier_date = $sd; // Mengupdate tanggal supplier
            $data->location = $l; // Mengupdate lokasi

            // Menyimpan perubahan ke database
            $data->save();
        } else {
            // Jika data tidak ditemukan, Anda bisa menambahkan penanganan error di sini
            throw new \Exception("Data barang tidak ditemukan.");
        }
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'products_id'); // 'products_id' adalah nama kolom foreign key di cart
    }

}
