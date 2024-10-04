@extends('layouts.conq')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Tinting</title>
</head>

<body>
    @if ($data->isEmpty())
        <h4 class="text-center mt-5"><strong>Belum ada data yang disimpan</strong></h4>
    @else
        <div class="container-fluid py-5">
            <h2 class="text-center mb-4"><strong>Daftar Barang Tinting</strong></h2>
            <div class="table-responsive">
                <table id="barang-tinting-table" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Berat</th>
                            <th>Stok</th>
                            <th>Harga Jual</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->type }}</td>
                                <td>{{ $d->weight }}</td>
                                <td>{{ $d->stock }}</td>
                                <td>{{ number_format($d->sales_price, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="editBarang({{ $d->id }})">Edit</button>
                                </td>
                                <td>
                                    <a href="/deletetinting/{{ $d->id }}" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini : {{ $d->name }}')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="modal fade" id="modalEdits" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalEditContents">
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
    $(document).ready(function () {
        $("#barang-tinting-table").DataTable();
    });
</script>
@endsection

@section('js')
<script>
    // AJAX untuk edit barang
    function editBarang(id) {
        $.ajax({
            type: 'POST',
            url: '/modalEditTinting',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {
                $('#modalEditContents').html(data.msg);
                $('#modalEdits').modal('show'); // Show modal after loading content
            }
        });
    }
</script>
@endsection

<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .container-fluid {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #004C99;
        font-weight: 700;
    }

    table {
        margin-top: 20px;
        width: 100%;
    }

    thead th {
        background-color: #004C99;
        color: white;
        font-weight: bold;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn {
        padding: 5px 10px;
        border-radius: 4px;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #333;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: #fff;
    }
</style>