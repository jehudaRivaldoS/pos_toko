<?php

namespace App\Http\Controllers;

use App\Models\ProductTinting;
use App\Models\TransaksiProductTinting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use log;

class TransaksiProductTintingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $jenis_cat = $request->input('jenis_cat'); // Ambil input jenis_cat
        $omset = 0;
        $untung = 0;

        // Query untuk mengambil data yang diinginkan dengan join ke tabel ProductTinting
        $query = TransaksiProductTinting::join('product_tinting', 'transaction_product_tinting.product_tinting_id', '=', 'product_tinting.id')
            ->select(
                'transaction_product_tinting.id as transaksi_id',
                'product_tinting.name as nama_barang',
                'product_tinting.weight as kapasitas',
                'product_tinting.type as tipe',
                'product_tinting.sales_price as sales_price',
                'transaction_product_tinting.seller_price_fix as harga_beli',
                'transaction_product_tinting.price as harga_jual',
                'transaction_product_tinting.profit as untung',
                'transaction_product_tinting.qty as qty', // Perbaiki ini jika qty adalah kolom yang ada di tabel
                'transaction_product_tinting.date as tanggal'
            );

        // Filter berdasarkan tanggal jika ada input start dan end
        if ($start && $end) {
            $query->whereBetween('transaction_product_tinting.date', [$start, $end]);
        }

        // Filter berdasarkan jenis_cat jika ada input
        if ($jenis_cat && $jenis_cat != 'semua') {
            $query->where('product_tinting.name', "=",$jenis_cat);
        }

        $omset = $query->sum('transaction_product_tinting.seller_price_fix');
        $untung = $query->sum('transaction_product_tinting.profit');

        // Eksekusi query dan ambil hasilnya
        $data = $query->get();

        return view('laporantinting', compact('data', 'start', 'end', 'omset', 'untung'));
    }


    public function store(Request $request)
    {
        // Simpan data ke database
        DB::table('transaction_product_tinting')->insert([
            'product_tinting_id' => $request->p_id,
            'qty' => $request->qty,
            'colour' => $request->colour,
            'seller_price_fix' => $request->seller_price_fix,
            'price' => $request->price,
            'profit' => $request->profit,
            'date' => $request->date,
        ]);

        // Pengurangan stok produk
        $product = ProductTinting::find($request->p_id);
        if ($product) {
            $product->stock -= $request->qty;
            if ($product->stock < 0) {
                return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi']);
            }
            $product->save();
        } else {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan']);
        }

        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan dan stok diperbarui.']);
    }

    public function deleteBarang($id)
    {
        $data = TransaksiProductTinting::find($id);

        $data->delete();
        return redirect()->back();
    }
}
