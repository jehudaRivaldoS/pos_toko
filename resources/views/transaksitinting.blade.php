@extends('layouts.conq')

@section('content')
<div class="container-fluid py-5">
    @if ($data->isEmpty())
        <h4 class="text-center"><strong>Belum ada data yang disimpan</strong></h4>
    @else
        <h2 class="text-center mb-4"><strong>Transaksi Cat Tinting NIPPON PAINT</strong></h2>
        <div class="table-responsive">
            <table id="barang-tinting-table" class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Type</th>
                        <th>Berat</th>
                        <th>Qty</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Tambah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>
                                <input type="text" id="id-{{ $d->id }}" class="form-control" value="{{ $d->id }}" readonly style="width: 60px;">
                            </td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->weight }}</td>
                            <td>
                                <input type="number" id="qty-{{ $d->id }}" class="form-control" min="1" value="1" placeholder="Masukkan Qty" style="width: 80px;" />
                            </td>
                            <td>
                                <input type="text" id="colour-{{ $d->id }}" class="form-control" placeholder="Masukkan warna" />
                            </td>
                            <td>
                                <input type="text" id="sales_price-{{ $d->id }}" class="form-control" placeholder="Masukkan harga" style="width: 80%;" />
                            </td>
                            <td>
                                <button class="btn btn-warning" onclick="addTinting({{ $d->id }})">Tambah</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#barang-tinting-table").DataTable();
    });

    function addTinting(id) {
        // Ambil input dari tabel
        var b_id = id;
        var qty = $('#qty-' + id).val();
        var colour = $('#colour-' + id).val();
        var sales_price = $('#sales_price-' + id).val();
        var seller_price_fix = sales_price * qty;
        var price = seller_price_fix * 0.9;
        var profit = seller_price_fix * 0.1;

        // Ambil tanggal sekarang
        var currentDate = new Date();
        var year = currentDate.getFullYear(); // Mendapatkan tahun
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Mendapatkan bulan dengan dua digit
        var day = ('0' + currentDate.getDate()).slice(-2); // Mendapatkan tanggal dengan dua digit

        // Mengubah ke format Y-m-D
        var date = year + '-' + month + '-' + day;

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '/tinting/store', // URL dari route Laravel
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Tambahkan CSRF token
                p_id: b_id,
                qty: qty,
                colour: colour,
                seller_price_fix: seller_price_fix,
                price: price,
                profit: profit,
                date: date
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Tampilkan pesan sukses
                    location.reload();
                } else {
                    alert('Error: ' + response.message); // Tampilkan pesan error jika ada
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText); // Tampilkan error
            }
        });
    }
</script>
@endsection

@section('style')
<style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .thead-dark {
        background-color: #343a40;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
        border: none;
        border-radius: 5px;
        padding: 6px 12px;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    /* Media queries untuk layar kecil */
    @media (max-width: 768px) {
        .table-responsive {
            margin-top: 10px;
        }

        .table {
            font-size: 12px; /* Ukuran font lebih kecil di perangkat kecil */
        }

        .form-control {
            font-size: 12px;
        }
    }
</style>
@endsection
