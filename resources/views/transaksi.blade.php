@extends('layouts.conq')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>
    <style>
        .form-group-container {
            display: flex;
            gap: 20px;
            /* Jarak antar elemen */
            justify-content: space-between;
            /* Agar form bisa terdistribusi dengan baik */
            align-items: flex-start;
        }

        .form-group {
            flex: 1;
            /* Menyebar sama rata */
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select.form-control {
            width: 100%;
        }

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

        h3 {
            color: #004C99;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #34495e;
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
            background-color: #004C99;
            color: white;
            text-align: center;
        }

        .table td {
            background-color: #ffffff;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
            /* Menambahkan margin untuk spasi */
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

        .btn-success {
            background-color: #28a745;
            border: none;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .total-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h3><strong>Transaksi Penjualan</strong></h3>
        <h5><strong>Pilih Barang:</strong></h5>
        @if ($barang->isEmpty())
            <h3><strong>Belum ada barang terdaftar</strong></h3>
        @else
            <div class="table-responsive">
                <table id="barang-table" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual (R)</th>
                            <th>Qty</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $d)
                            <tr>
                                <td>
                                    <input type="text" id="product_id-{{ $d->id }}" class="form-control" value="{{ $d->id }}"
                                        readonly style="width: 70px;" />
                                </td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->stock }}</td>
                                <td>{{ $d->unit }}</td>
                                <td>
                                    <input type="text" id="price_buy-{{ $d->id }}" class="form-control"
                                        value="{{ number_format($d->price_buy, 0, ',', '.') }}" readonly style="width: 100%;" />
                                </td>
                                <td>{{ number_format($d->price_sell_recomendation, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" id="qty-{{ $d->id }}" class="form-control" min="1" value="1"
                                        placeholder="Qty" style="width: 70px;" />
                                </td>
                                <td>
                                    <input type="text" id="sales_price-{{ $d->id }}" class="form-control"
                                        placeholder="Masukkan harga" style="width: 100%;" />
                                </td>
                                <td>
                                    <button class="btn btn-warning" onclick="addCart({{ $d->id }})">Tambah</button>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
        @endif
        </div>
        <div>
            <h3><strong>Daftar Belanja</strong></h3>
            @if ($cart->isEmpty())
                <h4><strong>Belum ada barang yang dipilih</strong></h4>
            @else
                <table id="barang-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Jual @</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $c)
                            <tr>
                                <td>{{ $c->product->id }}</td>
                                <td>{{ $c->product->name }}</td>
                                <td>{{ number_format($c->price, 0, ',', '.') }}</td>
                                <td>{{ $c->qty }}</td>
                                <td>{{ number_format($c->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="/deletetransaksi/{{$c->id}}" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data Transaksi ini : {{ $c->id }}')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="total-container">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="form-group-container">
                            <div class="form-group">
                                <label for="customer">Pilih Customer</label>
                                <select name="customers_id" id="customer" class="form-control" required>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Belum Bayar">Belum Bayar</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_status">Status Pembayaran</label>
                                <select name="payment_status" id="payment_status" class="form-control" required>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Tempo">Tempo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="total-container">
                    <h4 id="total_price"><strong>Total Belanja: Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                    </h4>
                    <div>
                        <a href="/clear-cart" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data Daftar Belanja ini')">Kosongkan
                            Transaksi</a> <!-- Tombol Kosongkan Transaksi -->
                        <button class="btn btn-success" onclick="addTransaksi()">Input Transaksi</button>
                    </div>
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
        $("#barang-table").DataTable({
            pageLength: 2,
            lengthMenu: [2],
            info: false,
            lengthChange: false,

        });
    });
    function addCart(id) {
        var product_id = $('#product_id-' + id).val();
        var qty = $('#qty-' + id).val();
        var sales_price = $('#sales_price-' + id).val();
        var price_buy = $('#price_buy-' + id).val().replace(/\./g, '');
        var user_id = "{{ Auth::user()->id }}";
        ;

        console.log(user_id)


        if (!sales_price || qty < 1) {
            alert("Masukkan jumlah dan harga jual yang valid");
            return;
        }
        // Hitung seller_price_fix dan untung
        var seller = qty * price_buy;
        var all_price = sales_price * qty;
        var profit = all_price - seller;

        //send data to controller
        $.ajax({
            url: '/cart/store', // URL dari route Laravel
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Tambahkan CSRF token
                product_id: product_id,
                seller_price_fix: price_buy,
                qty: qty,
                price: sales_price,
                total_price: all_price,
                untung: profit,
                user_id: user_id,
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message); // Tampilkan pesan error
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + xhr.responseText); // Tampilkan pesan error
            }
        });
    }
    function addTransaksi() {
        var totalPriceTexts = $('#total_price').text();
        var totalPriceText = parseInt(totalPriceTexts.replace(/[^0-9]/g, ''), 10);
        var date = new Date();
        var dates = date.toISOString().split('T')[0];

        var customerSelect = document.getElementById('customer');
        var paymentMethodSelect = document.getElementById('payment_method');
        var paymentStatusSelect = document.getElementById('payment_status');
        var cus = customerSelect.value;
        var method = paymentMethodSelect.value;
        var status = paymentStatusSelect.value;

        var user_id = "{{ Auth::user()->id }}";

        // Cetak nilai
        console.log(totalPriceText);
        console.log(dates);
        console.log(cus);
        console.log(method);
        console.log(status);
        console.log(user_id);

        $.ajax({
            url: '/transaction/store', // URL dari route Laravel
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Tambahkan CSRF token
                total_price: totalPriceText,
                transaction_date: dates,
                payment_method: method,
                payment_status: status,
                user_id: user_id,
                customer_id: cus,
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                    alert('Sukses Menyimpan transaksi');
                } else {
                    alert('Error: ' + response.message); // Tampilkan pesan error
                }
            },
            error: function (xhr, status, error) {
                alert('Error: ' + xhr.responseText); // Tampilkan pesan error
            }
        });
    }
</script>
@endsection