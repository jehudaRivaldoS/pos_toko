<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function printNota($id)
    {
        $transactionHeader = Transaksi::findOrFail($id);
        $transactionDetails = TransaksiDetail::where('transaction_header_id', $id)->get();

        return view('nota', compact('transactionHeader', 'transactionDetails'));
    }
}
