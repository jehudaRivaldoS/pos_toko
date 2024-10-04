@extends('layouts.conq')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>    
</head>

<body>
    @if ($data->isEmpty())
        <h4 class="text-center"><strong>Belum ada data yang disimpan</strong></h4>
    @else
        <div class="container-fluid">
            <h2 class="text-center"><strong>Daftar Barang</strong></h2>
            <table id="barang-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual (R)</th>
                        <th>Nama Supplier</th>
                        <th>Tanggal Supplier</th>
                        <th>Lokasi</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->stock }}</td>
                            <td>{{ $d->unit }}</td>
                            <td>{{ number_format($d->price_buy, 0, ',', '.') }}</td>
                            <td>{{ number_format($d->price_sell_recomendation, 0, ',', '.') }}</td>
                            <td>{{ $d->supplier_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->supplier_date)->format('d/m/Y') }}</td>
                            <td>{{ $d->location }}</td>
                            <td>
                                <button class="btn btn-warning" onclick="editUlasan({{ $d->id }})">Edit</button>
                            </td>
                            <td>
                                <a href="/delete/{{$d->id}}" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini : {{ $d->name }}')">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Modal Edit Barang -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalEditContent">
                <!-- Form edit barang akan dimuat melalui AJAX -->
            </div>
        </div>
    </div>

</body>

</html>
@endsection

@section('script')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $("#barang-table").DataTable();
    });
</script>
@endsection

@section('js')
<script>
    // AJAX untuk edit ulasan
    function editUlasan(id) {
        $.ajax({
            type: 'POST',
            url: '/modalEdit',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {
                $('#modalEditContent').html(data.msg);
                $('#modalEdit').modal('show'); // Show modal after loading content
            }
        });
    }
</script>
@endsection

<style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .container-fluid {
        width: 100%; /* Membuat kontainer penuh lebar */
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2, h4 {
        color: #4a4a4a;
    }

    table {
        width: 100%; /* Membuat tabel penuh lebar */
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #e0e0e0;
    }

    th {
        background-color: #004C99; /* Warna header tabel */
        color: #fff;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .btn {
        margin: 5px;
    }
</style>
