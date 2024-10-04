@extends('layouts.conq')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Cat Tinting</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form-inline {
            display: flex;
            align-items: center;
            /* Menyusun secara vertikal pada tengah */
            flex-wrap: wrap;
            /* Membuat label baru jika ruang tidak cukup */
        }

        .date-picker {
            margin-right: 20px;
            /* Jarak antar elemen tanggal dan radio button */
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            /* Membuat label baru jika ruang tidak cukup */
            margin-top: 10px;
            /* Jarak atas */
        }

        .radio-group label {
            margin-right: 20px;
            /* Jarak antar label */
            display: flex;
            align-items: center;
            /* Menyusun vertikal pada tengah */
        }

        /* Tambahan untuk mengatur jarak antara pilihan cat dan tombol Cari */
        #cari {
            margin-left: 20px;
            /* Jarak antara pilihan cat dan tombol cari */
        }

        .container {
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            /* Menentukan lebar kontainer agar lebih lebar */
        }

        h2 {
            color: #004C99;
            margin-bottom: 20px;
            text-align: center;
        }

        h3 {
            font-weight: bold;
            color: #333;
        }

        .card {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .table-responsive {
            margin-top: 20px;
        }

        /* Custom button style for export */
        .dt-button {
            background-color: #007bff !important;
            color: white !important;
            border-radius: 5px !important;
            padding: 6px 12px !important;
            font-size: 14px !important;
            border: none !important;
            margin-right: 10px !important;
        }

        .dt-button:hover {
            background-color: #0056b3 !important;
        }

        /* Media queries untuk layar kecil */
        @media (max-width: 768px) {
            h2 {
                font-size: 24px;
            }

            h3 {
                font-size: 20px;
            }

            .col-md-6,
            .col-md-3,
            .col-md-2 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><strong>Laporan Cat Tinting NIPPON PAINT</strong></h2>
        <div class="card">
            <h3><strong>Cari dengan Tanggal:</strong></h3>
            <form action="{{ route('tinting.index') }}" method="GET" class="form-inline">
                <div class="date-picker">
                    <label for="start">Mulai:</label>
                    <input type="date" name="start" id="start" value="{{ request('start') }}">

                    <label for="end">- Akhir:</label>
                    <input type="date" name="end" id="end" value="{{ request('end') }}">
                </div>

                <h5><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilih Jenis Cat:
                        &nbsp;&nbsp;&nbsp;&nbsp;</strong></h5>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="jenis_cat" value="semua" {{ request('jenis_cat', 'semua') == 'semua' ? 'checked' : '' }}>
                        Semua
                    </label>
                    <label>
                        <input type="radio" name="jenis_cat" value="NIPPON PAINT KOMILEX GOLD Cat Interior" {{ request('jenis_cat') == 'NIPPON PAINT KOMILEX GOLD Cat Interior' ? 'checked' : '' }}>
                        Komilex Gold
                    </label>
                    <label>
                        <input type="radio" name="jenis_cat" value="NIPPON PAINT ELASTEX WATERPROOFING Cat Anti Bocor"
                            {{ request('jenis_cat') == 'NIPPON PAINT ELASTEX WATERPROOFING Cat Anti Bocor' ? 'checked' : '' }}>
                        Elastex
                    </label>
                    <label>
                        <input type="radio" name="jenis_cat" value="NIPPON PAINT VINILEX PRO 1000 Cat Interior" {{ request('jenis_cat') == 'NIPPON PAINT VINILEX PRO 1000 Cat Interior' ? 'checked' : '' }}>
                        Vinilex Pro 1000
                    </label>
                    <label>
                        <input type="radio" name="jenis_cat"
                            value="NIPPON PAINT VINILEX 5000 Cat Interior dan Eksterior" {{ request('jenis_cat') == 'NIPPON PAINT VINILEX 5000 Cat Interior dan Eksterior' ? 'checked' : '' }}>
                        Vinilex 5000
                    </label>
                    <label>
                        <input type="radio" name="jenis_cat" value="NIPPON PAINT WEATHERBOND Cat Eksterior" {{ request('jenis_cat') == 'NIPPON PAINT WEATHERBOND Cat Eksterior' ? 'checked' : '' }}>
                        Weatherbond
                    </label>
                </div>
                <button type="submit" id="cari" class="btn">Cari</button>
            </form>
        </div>

        <div class="row">
            @if ($data->isEmpty())
                <h4 class="text-center"><strong>Belum ada data yang disimpan</strong></h4>
            @else
                @if ($start == null && $end == null)
                    <h5><strong>Untuk mengetahui Omset dan Keuntungan, pilih range tanggalnya terlebih dahulu</strong></h5>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <h5><strong>Omset Penjualan tanggal {{ \Carbon\Carbon::parse(request('start'))->format('d-m-Y') }}
                                    sampai {{ \Carbon\Carbon::parse(request('end'))->format('d-m-Y') }}: Rp
                                    {{ number_format($omset, 0, ',', '.') }}</strong></h5>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Keuntungan Penjualan tanggal
                                    {{ \Carbon\Carbon::parse(request('start'))->format('d-m-Y') }} sampai
                                    {{ \Carbon\Carbon::parse(request('end'))->format('d-m-Y') }}: Rp
                                    {{ number_format($untung, 0, ',', '.') }}</strong></h5>
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="barang-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Transaksi</th>
                                <th>Nama Barang</th>
                                <th>Type</th>
                                <th>Kapasitas</th>
                                <th>Harga Beli Base</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Profit</th>
                                <th>Tanggal</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $d)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$d->transaksi_id}}</td>
                                    <td>{{$d->nama_barang}}</td>
                                    <td>{{$d->tipe}}</td>
                                    <td>{{$d->kapasitas}}</td>
                                    <td>Rp {{ number_format($d->sales_price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($d->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($d->harga_jual, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($d->untung, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="/deleted/{{$d->transaksi_id}}" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data Transaksi ini : {{ $d->transaksi_id }}')">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var omset = {{ number_format($omset, 0, '', '') }}; // Ambil nilai omset sebagai angka
        var untung = {{ number_format($untung, 0, '', '') }}; // Ambil nilai untung sebagai angka
        var startDate = "{{ request('start') }}";
        var endDate = "{{ request('end') }}";

        $("#barang-table").DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                    title: 'Laporan Penjualan Cat Tinting',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]  // Kolom yang ingin diexport ke PDF
                    },
                    customize: function (doc) {
                        // Custom styling PDF
                        doc.content[1].table.widths = ['10%', '15%', '10%', '10%', '15%', '15%', '15%', '10%'];

                        // Tambahkan rentang tanggal, total omset, dan keuntungan di bawah tabel
                        doc.content.push({
                            margin: [0, 20, 0, 0],
                            table: {
                                widths: ['*', '*'],
                                body: [
                                    [{ text: 'Rentang Tanggal:', bold: true }, { text: startDate + ' - ' + endDate, alignment: 'right' }],
                                    [{ text: 'Total Omset:', bold: true }, { text: 'Rp ' + omset.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."), alignment: 'right' }],
                                    [{ text: 'Total Keuntungan:', bold: true }, { text: 'Rp ' + untung.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."), alignment: 'right' }]
                                ]
                            },
                            layout: 'lightHorizontalLines'
                        });
                    }
                }
            ],
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100], // Pilihan jumlah baris yang ditampilkan
        });
    });
</script>
@endsection