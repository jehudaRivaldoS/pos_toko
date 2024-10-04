<?php

namespace App\Http\Controllers;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $barang = Barang::all();
        $cart = Cart::with('products')->get();

        $totalPrice = $cart->sum('total_price'); // Menggunakan koleksi untuk mendapatkan sum

        return view('transaksi', compact('customers', 'barang', 'cart', 'totalPrice'));
    }
    public function indexDetail($id)
    {
        set_time_limit(6000);

        // Mengambil data transaksi header sesuai ID
        $transaksiHeader = Transaksi::with('details')->find($id);

        if ($transaksiHeader) {
            return view('transaksidetail', ['transaksiHeader' => $transaksiHeader]);
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    public static function ubahStatus($id)
    {
        set_time_limit(6000);

        $data = Transaksi::find($id);

        if ($data) {
            // Mengganti status 'pay' antara 'lunas' dan 'Tempo'
            if ($data->pay == 'lunas') {
                $data->pay = 'Tempo';
                $data->payment_method = 'Belum Bayar';
            } else if ($data->pay == 'Tempo') {
                $data->pay = 'lunas';
                $data->payment_method = 'Cash';
            }
            // Simpan perubahan ke database
            $data->save();

            return response()->json(['success' => true, 'message' => 'Status pembayaran dan metode pembayaran berhasil diubah.']);
        }

        return response()->json(['success' => false, 'message' => 'Data transaksi tidak ditemukan.']);
    }


    public function indexLaporan()
    {
        $transaksi = Transaksi::all();
        $customer = Customer::with('transaksi')->get();
        $user = User::with(relations: 'transaksi')->get();

        return view('laporantransaksi', compact('transaksi', 'customer', 'user'));
    }
    public function clearCart()
    {
        // Hapus semua item dari keranjang
        Cart::truncate(); // Atau sesuai dengan logika penyimpanan keranjang Anda
        return redirect()->back()->with('success', 'Transaksi berhasil dikosongkan!');
    }
    public function deleteBarang($id)
    {
        $data = Cart::find($id);

        $data->delete();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        // Simpan data ke database
        DB::table('cart')->insert([
            'products_id' => $request->product_id,
            'seller_price_fix' => $request->seller_price_fix,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'untung' => $request->untung,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan']);
    }
    public function storeTransaksi(Request $request)
    {
        DB::beginTransaction();

        $cartItems = Cart::where('user_id', $request->user_id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja kosong'
            ], 400);
        }

        $totalProfit = $cartItems->sum('untung');

        try {
            // 1. Simpan data transaksi ke transaction_header
            $transactionHeader = new Transaksi();
            $transactionHeader->total_amount = $request->total_price; // Dari form transaksi
            $transactionHeader->total_profit = $totalProfit;
            $transactionHeader->transaction_date = $request->transaction_date; // Tanggal sekarang
            $transactionHeader->payment_method = $request->payment_method; // Metode pembayaran dari form
            $transactionHeader->pay = $request->payment_status; // Jumlah pembayaran dari form
            $transactionHeader->users_id = $request->user_id; // User yang sedang login
            $transactionHeader->customers_id = $request->customer_id; // Customer yang dipilih
            $transactionHeader->save();

            // 2. Ambil data dari tabel cart berdasarkan user_id yang sedang login
            $cartItems = Cart::where('user_id', $request->user_id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang belanja kosong'
                ], 400);
            }

            // 3. Simpan setiap item cart ke dalam transaction_detail
            foreach ($cartItems as $item) {
                $transactionDetail = new TransaksiDetail();
                $transactionDetail->transaction_headers_id = $transactionHeader->id; // Foreign key dari header
                $transactionDetail->products_id = $item->products_id; // Produk dari cart
                $transactionDetail->seller_price_fix = $item->seller_price_fix; // Harga beli produk
                $transactionDetail->qty = $item->qty; // Kuantitas produk
                $transactionDetail->price = $item->price; // Harga jual produk
                $transactionDetail->total_price = $item->total_price; // Total harga
                $transactionDetail->untung = $item->untung; // Keuntungan
                $transactionDetail->save();

                $product = Barang::find($item->products_id);
                if ($product) {
                    $product->stock -= $item->qty; // Kurangi stok berdasarkan qty
                    $product->save(); // Simpan perubahan stok
                }
            }

            // 4. Hapus data dari cart setelah berhasil disimpan ke transaction_detail
            Cart::where('user_id', $request->user()->id)->delete();

            // Commit transaksi database
            DB::commit();

            $this->printNota($transactionHeader->id);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
    public function printNota($transactionId)
    {
        // Ambil data dari database berdasarkan transaction ID
        $transactionHeader = Transaksi::find($transactionId);
        $transactionDetails = TransaksiDetail::where('transaction_headers_id', $transactionId)->get();

        // Konfigurasi koneksi printer
        $printerName = "ZJ-58"; // Pastikan ini nama printer yang tepat
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);

        // Cetak 2 kali: Asli dan Copy
        // $copies = ['Asli', 'Copy'];
        $copies = ['Asli'];

        foreach ($copies as $copyType) {
            // Mencetak nota
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("TOKO MAJU\n");
            $printer->text("Bahan Bangunan dan Alat Teknik\n");
            $printer->text("085235972312\n");
            $printer->text("Nota Transaksi ({$copyType})\n");
            $printer->text("Transaction ID: {$transactionHeader->id}\n");

            // Ambil nama customer jika relasi ada
            $customer = $transactionHeader->customer ? $transactionHeader->customer->name : 'Customer Tidak Diketahui';
            $printer->text("Customer: {$customer}\n");

            // Ambil nama sales jika relasi ada
            $sales = $transactionHeader->user ? $transactionHeader->user->name : 'Sales Tidak Diketahui';
            $printer->text("Sales: {$sales}\n");

            $printer->text("--------------------------------\n");

            // Inisialisasi total transaksi
            $totalAmount = 0;

            // Ambil data item dari detail transaksi dan cetak
            foreach ($transactionDetails as $detail) {
                // Ambil nama barang dari relasi product atau barang
                $product = $detail->product ? $detail->product->name : 'Barang Tidak Diketahui';

                // Hitung total per item (qty * harga satuan)
                $totalPerItem = $detail->qty * $detail->price;

                // Cetak nama barang, kuantitas, harga satuan, dan total per item
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("{$product}\n");
                $printer->text("Qty: {$detail->qty} x " . number_format($detail->price, 0, ',', '.') . ": Rp " . number_format($totalPerItem, 0, ',', '.') . "\n");
                $printer->text("--------------------------------\n");

                // Tambahkan ke total transaksi
                $totalAmount += $totalPerItem;
            }

            // Cetak total transaksi keseluruhan
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("Total Belanja: Rp " . number_format($totalAmount, 0, ',', '.') . "\n");

            // Tambahkan layer kosong agar kertas naik
            $printer->feed(3); // Memberikan 3 baris kosong untuk menambah jarak

            // Potong kertas setelah semua cetakan selesai
            $printer->cut();
        }

        $printer->close();
    }
    public function hapusTransaksi($id)
    {
        // Mengambil transaksi header berdasarkan ID
        $transaksiHeader = Transaksi::find($id);

        if (!$transaksiHeader) {
            return response()->json(['success' => false, 'message' => 'Transaksi tidak ditemukan.']);
        }

        // Mengambil semua detail transaksi yang berhubungan dengan transaksi header
        $transaksiDetails = TransaksiDetail::where('transaction_headers_id', $id)->get();

        // Loop melalui detail transaksi dan kembalikan stok barang sesuai transaksi
        foreach ($transaksiDetails as $detail) {
            $barang = Barang::find($detail->products_id);

            if ($barang) {
                // Menambahkan kembali stok barang sesuai dengan qty yang di cancel
                $barang->stock += $detail->qty;
                $barang->save();
            }

            // Hapus detail transaksi
            $detail->delete();
        }

        // Setelah semua detail transaksi dihapus, hapus header transaksi
        $transaksiHeader->delete();

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil dihapus dan stok barang dikembalikan.']);
    }

}