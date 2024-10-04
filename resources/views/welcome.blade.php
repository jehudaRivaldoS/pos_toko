@extends('layouts.conq')

@section('content')

<div class="container py-5">
    <div class="header-section text-center mb-5">
        <h1 class="display-4 font-weight-bold"><strong>Selamat Datang di POS Toko Bangunan Maju</strong></h1>
        <p class="lead">Jl. Raya Minggiran No.74, Minggiran, Papar, Kabupaten Kediri</p>
        <div class="underline"></div> <!-- Decorative underline -->
    </div>

    <div class="user-info text-center mb-5">
        <h3 class="mb-3">User Aktif: 
            <strong>
                @if (Auth::check())
                    {{ Auth::user()->name }}
                @else
                    Belum login
                @endif
            </strong>
        </h3>
        <p class="text-muted">Login untuk mengakses semua fitur toko secara penuh.</p>
    </div>

    <div class="action-buttons text-center mt-5">
        <a href="{{ route('barang.index') }}" class="btn btn-fancy mx-2">Lihat Barang</a>
        <a href="{{route('transaksi.index')}}" class="btn btn-fancy mx-2">Mulai Transaksi</a>
        <a href="/" class="btn btn-fancy mx-2">Lihat Laporan</a>
    </div>

    <!-- User Rules Section -->
    <div class="rules-section text-center mt-5">
        <h4 class="text-uppercase mb-4"><strong>Peraturan Penggunaan User</strong></h4>
        <ul class="rules-list list-unstyled">
            <li>1. Memberi nama barang dilarang menggunakan "/"</li>
            <li>2. Dilarang melakukan SQL Inject</li>
            <li>3. Dilarang menggunakan akun milik orang lain</li>
            <li>4. Harus login terlebih dahulu sebelum melakukan aktivitas</li>
        </ul>
    </div>
</div>

<style>
    body {
        background-color: #1a1a1d;
        color: #f0f0f0;
        font-family: 'Helvetica Neue', sans-serif;
        margin: 0;
    }

    .container {
        max-width: 1200px;
        background-color: #2e2e38;
        padding: 50px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
    }

    /* Header Section */
    .header-section h1 {
        color: #fff;
        font-size: 3rem;
        margin-bottom: 10px;
        background: linear-gradient(90deg, #ff8a00, #e52e71);
        -webkit-background-clip: text;
        color: transparent;
    }

    .header-section .lead {
        color: #b0b0b0;
        font-size: 1.3rem;
    }

    .underline {
        width: 100px;
        height: 5px;
        background: #ff8a00;
        margin: 20px auto;
        border-radius: 50px;
    }

    /* User Info */
    .user-info h3 {
        color: #ff8a00;
        font-weight: 600;
    }

    /* Buttons */
    .btn-fancy {
        background-color: #e52e71;
        border: none;
        color: #fff;
        padding: 12px 40px;
        font-size: 1.1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 15px rgba(229, 46, 113, 0.3);
    }

    .btn-fancy:hover {
        background-color: #ff8a00;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 138, 0, 0.4);
    }

    /* User Rules */
    .rules-section {
        margin-top: 50px;
    }

    .rules-section h4 {
        font-size: 1.5rem;
        color: #fff;
        border-bottom: 2px solid #ff8a00;
        display: inline-block;
        padding-bottom: 5px;
    }

    .rules-list {
        margin-top: 20px;
        font-size: 1.2rem;
        color: #b0b0b0;
    }

    .rules-list li {
        margin-bottom: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .rules-list li i {
        color: #ff8a00;
        margin-right: 10px;
    }
</style>

@endsection
