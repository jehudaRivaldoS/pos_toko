@extends('layouts.conq')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <style>
        /* Umum */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .container {
            max-width: 1200px;
            /* Mengubah lebar maksimum kontainer */
            margin: 0 auto;
            padding: 20px;
        }

        /* Card styling */
        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #34495e;
            margin-bottom: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        input[type="text"] {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #2980b9;
        }

        /* Button Styling */
        .btn-submit {
            background-color: #2980b9;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background-color: #1c598a;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .card {
                padding: 20px;
            }

            .btn-submit {
                padding: 12px;
            }
        }

        /* Alert Success Styling */
        .alert {
            padding: 15px;
            background-color: #4caf50;
            color: white;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><strong>Tambah Data Customer Toko Maju</strong></h2>
        <div class="card">
            <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('customer.store') }}" method="POST">
                @csrf <!-- Tambahkan CSRF token untuk keamanan -->
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama lengkap customer">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" id="address" name="address" class="form-control"
                        placeholder="Alamat lengkap customer">
                </div>
                <button type="submit" class="btn-submit">Simpan</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h2><strong>Daftar Customer Toko Maju</strong></h2>
        @if ($data->isEmpty())
            <h4 class="text-center"><strong>Belum ada data yang disimpan</strong></h4>
        @else
            <div class="container-fluid">
                <table id="barang-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>

</html>

@endsection

@section('script')
<script>
    // Inisialisasi DataTable
    $(document).ready(function () {
        $("#barang-table").DataTable();
    });
</script>
@endsection