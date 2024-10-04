<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan oleh model ini
    protected $table = 'customers';
    public $timestamps = false;

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Relasi ke model `Transaksi`
     * Setiap customer dapat memiliki banyak transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'customers_id');
    }
}
