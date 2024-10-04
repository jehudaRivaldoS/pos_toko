<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'transaction_headers';
    public $timestamps = false;

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'total_amount',
        'total_profit',
        'transaction_date',
        'payment_method',
        'pay',
        'users_id',
        'customers_id'
    ];

    public static function edits($id)
    {
        set_time_limit(6000);

        $data = Transaksi::find($id);

        if ($data) {
            if ($data->pay == 'lunas') {
                $data->pay = 'Tempo';
            } else if ($data->pay == 'Tempo') {
                $data->pay = 'lunas';
            }

            $data->save(); // Jangan lupa untuk menyimpan perubahan ke database
        } else {
            // Jika data tidak ditemukan, Anda bisa menambahkan penanganan error di sini
            throw new \Exception("Data barang tidak ditemukan.");
        }
    }

    /**
     * Relasi ke model `User`
     * Transaksi dilakukan oleh seorang user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Relasi ke model `Customer`
     * Setiap transaksi dilakukan untuk satu customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    /**
     * Relasi ke model `TransactionDetail`
     * Setiap transaksi bisa memiliki banyak detail transaksi
     */
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaction_headers_id');
    }
}
