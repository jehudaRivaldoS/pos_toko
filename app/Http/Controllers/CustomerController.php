<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::all();

        return view('customer', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Simpan data ke database (ID diatur secara otomatis oleh auto-increment)
        Customer::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Customer berhasil ditambahkan!');
    }
}
