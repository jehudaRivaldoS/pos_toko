@extends('layouts.conq')

@section('content')
<div class="container">
    <h2 class="text-center my-4"><strong>Tambah Barang</strong></h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name" class="font-weight-bold">Nama Barang <span class="text-danger">(Peringatan: Jangan
                    menggunakan tanda / !!!)</span>:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock" class="font-weight-bold">Stok:</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="unit" class="font-weight-bold">Satuan:</label>
            <select name="unit" id="unit" class="form-control" required>
                <option value="" disabled selected>Pilih Satuan</option>
                <option value="Pcs" {{ old('unit') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                <option value="Set" {{ old('unit') == 'Set' ? 'selected' : '' }}>Set</option>
                <option value="Meter" {{ old('unit') == 'Meter' ? 'selected' : '' }}>Meter</option>
            </select>
            @error('unit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price_buy" class="font-weight-bold">Harga Beli:</label>
            <input type="number" step="0.01" name="price_buy" id="price_buy" class="form-control"
                value="{{ old('price_buy') }}" required>
            @error('price_buy')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price_sell_recomendation" class="font-weight-bold">Harga Jual Rekomendasi:</label>
            <input type="number" step="0.01" name="price_sell_recomendation" id="price_sell_recomendation"
                class="form-control" value="{{ old('price_sell_recomendation') }}" required>
            @error('price_sell_recomendation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="supplier_name" class="font-weight-bold">Nama Supplier:</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control"
                value="{{ old('supplier_name') }}" required>
            @error('supplier_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="supplier_date" class="font-weight-bold">Tanggal Barang Datang:</label>
            <input type="date" name="supplier_date" id="supplier_date" class="form-control"
                value="{{ old('supplier_date') }}" required>
            @error('supplier_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="location" class="font-weight-bold">Lokasi:</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}"
                required>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center my-4">
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
    </form>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #f8f9fa;
        /* Warna latar belakang */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        font-size: 1.1em;
    }

    .text-danger {
        font-size: 0.9em;
    }

    h2 {
        color: #004C99;
        /* Ganti warna judul */
    }

    button.btn-primary {
        background-color: #004C99;
        /* Ganti warna tombol */
        border: none;
    }

    button.btn-primary:hover {
        background-color: #003366;
        /* Ganti warna saat hover */
    }
</style>
@endsection