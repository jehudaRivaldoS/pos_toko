<?php

namespace App\Http\Controllers;

use App\Models\ProductTinting;
use Illuminate\Http\Request;

class ProductTintingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ProductTinting::all();

        return view('barangtinting', compact('data'));
    }

    public function deleteBarang($id)
    {
        $data = ProductTinting::find($id);

        $data->delete();
        return redirect()->back();
    }

    public function shows()
    {
        return view('tambahtinting');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'weight' => 'required|string|max:30',
            'stock' => 'required|integer',
            'sales_price' => 'required|numeric',
            'date' => 'required|date', // Validasi untuk date
        ]);

        // Simpan data ke database (ID diatur secara otomatis oleh auto-increment)
        ProductTinting::create([
            'name' => $request->name,
            'type' => $request->type,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'sales_price' => $request->sales_price,
            'date' => $request->date, // Simpan date juga
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $re, $id)
    {
        // Mengambil data dari request
        $name = $re->get('name');
        $type = $re->get('type');
        $weight = $re->get('weight');
        $stock = $re->get('stock');
        $sales_price = $re->get('sales_price');

        // Memanggil fungsi updateProduct untuk mengupdate data produk
        ProductTinting::updateProduct($id, $name, $type, $weight, $stock, $sales_price);

        // Menampilkan pesan sukses setelah update
        $re->session()->flash('success', 'Berhasil melakukan update data produk.');

        // Mengembalikan ke halaman sebelumnya
        return redirect()->back();
    }
    public function editShow(Request $request)
    {
        try {
            $id = $request->get('id');
            $data = ProductTinting::find($id);
            return response()->json(array(
                'msg' => view('edittinting', compact('data'))->render()
            ), 200);
        } catch (\Throwable $th) {
            Alert::error('GAGAL', 'Gagal');
            return back();
        }
    }
    public function addTransaksi()
    {
        $data = ProductTinting::all();

        return view('transaksitinting', compact('data'));
    }
}
