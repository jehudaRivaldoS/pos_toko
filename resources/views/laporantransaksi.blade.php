@extends('layouts.conq')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container-fluid {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #3498db;
            color: white;
            text-align: center;
        }

        .table td {
            background-color: #ffffff;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-warning {
            background-color: #f39c12;
            border: none;
            color: #fff;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
            color: #fff;
        }

        .btn-success {
            background-color: #27ae60;
            border: none;
            color: #fff;
        }

        .btn:hover {
            opacity: 0.9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .alert-message {
            color: red;
            font-weight: bold;
        }

        .total-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .total-container h4 {
            font-size: 1.2em;
            color: #2980b9;
        }

        .total-container .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h3><strong>Laporan Transaksi Penjualan</strong></h3>

        @if($transaksi->isEmpty())
            <p class="alert-message">Belum ada transaksi yang tercatat.</p>
        @else
            <div class="table-responsive">
                <table id="barang-table" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Sales</th>
                            <th>Total Belanja</th>
                            <th>Total Profit</th>
                            <th>Tanggal Belanja</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Ubah Status</th>
                            <th>Detail</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->customer->name }}</td>
                                <td>{{ $t->user->name }}</td>
                                <td>{{ number_format($t->total_amount, 0, ',', '.') }}</td>
                                <td>{{ number_format($t->total_profit, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($t->date)->format('d/m/Y') }}</td>
                                <td>{{ $t->payment_method }}</td>
                                <td>{{ $t->pay }}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="confirmEditTransaksi({{ $t->id }})">Edit
                                        Status</button>
                                </td>
                                <td>

                                    <a href="{{ route('transaction.detail', $t->id) }}" class="btn btn-info">
                                        Lihat Detail
                                    </a>
                                </td>

                                <td>
                                    <button class="btn btn-danger" onclick="hapusTransaksi({{ $t->id }})">
                                        Hapus Transaksi
                                    </button>
                                </td>
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
    $(document).ready(function () {
        $("#barang-table").DataTable();
    });
    function confirmEditTransaksi(transaksiId) {
        // Menampilkan dialog konfirmasi
        let confirmAction = confirm("Apakah Anda yakin ingin merubah status transaksi ini?");

        if (confirmAction) {
            editTransaksi(transaksiId); // Jika pengguna setuju, lanjutkan proses edit
        } else {
            alert("Perubahan dibatalkan."); // Jika pengguna membatalkan
        }
    }

    function editTransaksi(transaksiId) {
        // Melakukan AJAX request untuk mengubah status transaksi di server
        $.ajax({
            url: '/laporantransaksi/edits/' + transaksiId,  // URL menuju controller yang menangani perubahan status
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // Sertakan CSRF token untuk keamanan
            },
            success: function (response) {
                if (response.success) {
                    alert('Status transaksi berhasil diubah!');
                    location.reload(); // Refresh halaman setelah perubahan sukses
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + xhr.responseText); // Pesan error jika request gagal
            }
        });
    }
    function hapusTransaksi(transaksiId) {
        if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
            $.ajax({
                url: '/laporantransaksi/hapus/' + transaksiId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Refresh halaman jika penghapusan berhasil
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    }

</script>
@endsection