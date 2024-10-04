<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Barang::all();

        return view('barang', compact('data'));
    }
    public function shows()
    {
        return view('tambahb');
    }
    public function update(Request $re, $id)
    {
        $n = $re->get('nama_barang');
        $s = $re->get('stok');
        $sa = $re->get('satuan');
        $hb = $re->get('harga_beli');
        $hjr = $re->get('harga_jual_rekomendasi');
        $sn = $re->get('supplier_name');
        $sd = $re->get('supplier_date');
        $l = $re->get('lokasi');

        Barang::edits($id, $n, $s, $sa, $hb, $hjr, $sn, $sd, $l);

        $re->session()->flash('success', 'Berhasil melakukan update data');

        return redirect()->back();
    }
    public function editShow(Request $request)
    {
        try {
            $id = $request->get('id');
            $data = Barang::find($id);
            return response()->json(array(
                'msg' => view('editb', compact('data'))->render()
            ), 200);
        } catch (\Throwable $th) {
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }
    public function store(Request $request)
    {
        // Validasi input sesuai dengan kolom di tabel 'products'
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric',
            'unit' => 'required|string|max:45',
            'price_buy' => 'required|numeric',
            'price_sell_recomendation' => 'required|numeric',
            'supplier_name' => 'required|string|max:255',
            'supplier_date' => 'required|date',
            'location' => 'required|string|max:100',
        ]);

        // Buat instance baru dari model Product
        $product = new Barang();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->unit = $request->unit;
        $product->price_buy = $request->price_buy;
        $product->price_sell_recomendation = $request->price_sell_recomendation;
        $product->supplier_name = $request->supplier_name;
        $product->supplier_date = $request->supplier_date;
        $product->location = $request->location;

        // Simpan data ke database
        $product->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }
    public function deleteBarang($id)
    {
        $data = Barang::find($id);

        $data->delete();
        return redirect()->back();
    }
}
