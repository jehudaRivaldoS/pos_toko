@extends('layouts.conq')

@section('content')
<div class="container-fluid">
    <h2 class="text-center mb-4">Form Input Barang Tinting</h2>

    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Input -->
    <form action="{{ route('productinting.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <select class="form-select elegant-select dropdown-large" id="name" name="name" required>
                <option value="">Pilih Nama Produk</option>
                <option value="NIPPON PAINT KOMILEX GOLD Cat Interior">NIPPON PAINT KOMILEX GOLD Cat Interior</option>
                <option value="NIPPON PAINT ELASTEX WATERPROOFING Cat Anti Bocor">NIPPON PAINT ELASTEX WATERPROOFING Cat Anti Bocor</option>
                <option value="NIPPON PAINT VINILEX PRO 1000 Cat interior">NIPPON PAINT VINILEX PRO 1000 Cat interior</option>
                <option value="NIPPON PAINT VINILEX 5000 Cat Interior dan Eksterior">NIPPON PAINT VINILEX 5000 Cat Interior dan Eksterior</option>
                <option value="NIPPON PAINT WEATHERBOND Cat Eksterior">NIPPON PAINT WEATHERBOND Cat Eksterior</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipe</label>
            <select class="form-select elegant-select dropdown-large" id="type" name="type" required>
                <option value="">Pilih Tipe</option>
                <option value="PASTEL">PASTEL</option>
                <option value="ACCENT">ACCENT</option>
                <option value="DEEP">DEEP</option>
                <option value="TINT">TINT</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat</label>
            <input type="text" class="form-control elegant-input" id="weight" name="weight" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control elegant-input" id="stock" name="stock" required>
        </div>

        <div class="mb-4">
            <label for="sales_price" class="form-label">Harga Beli</label>
            <input type="number" step="0.01" class="form-control elegant-input" id="sales_price" name="sales_price" required>
        </div>

        <!-- Input untuk tanggal -->
        <div class="mb-4">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" class="form-control elegant-input" id="date" name="date" required>
        </div><br>

        <div class="text-end mt-4"> <!-- Memastikan tombol berada di kanan -->
            <button type="submit" class="btn elegant-button">Simpan</button>
        </div>
    </form>
</div>

<!-- Custom CSS -->
<style>
    /* Sama seperti style sebelumnya */
    body {
        background-color: #f4f9f9;
        font-family: 'Lato', sans-serif;
        color: #495057;
    }

    .container-fluid {
        max-width: 700px;
        margin: 60px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-weight: 700;
        color: #0f4c75;
        letter-spacing: 1px;
    }

    .form-label {
        font-size: 14px;
        color: #0f4c75;
        font-weight: 600;
    }

    .elegant-input, .elegant-select {
        background-color: #edf2f4;
        border: none;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        color: #495057;
        transition: background-color 0.3s ease;
    }

    .elegant-input:focus, .elegant-select:focus {
        background-color: #d1e7dd;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .dropdown-large {
        width: 100%;
        padding-right: 25px;
    }

    .form-select {
        appearance: none;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%230f4c75" d="M2 0L0 2h4zM2 5L0 3h4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px 10px;
    }

    .elegant-button {
        background-color: #0f4c75;
        color: #fff;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.2s;
        border: none;
    }

    .elegant-button:hover {
        background-color: #1b6f8f;
        transform: translateY(-3px);
    }

    .alert-success {
        background-color: #e7f7ee;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #c3e6cb;
    }
</style>
@endsection
