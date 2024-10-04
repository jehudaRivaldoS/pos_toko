<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .nota {
            width: 250px; /* Sesuaikan dengan lebar printer thermal */
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 10px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details th, .details td {
            padding: 5px;
            text-align: left;
        }
        .total {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="nota">
        <div class="header">
            <h2>Nota Transaksi</h2>
            <p>ID Transaksi: {{ $transactionHeader->id }}</p>
            <p>Nama Customer: {{ $transactionHeader->customer->name }}</p>
            <p>Nama Sales: {{ $transactionHeader->sales_name }}</p>
        </div>

        <div class="details">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionDetails as $detail)
                        <tr>
                            <td>{{ $detail->barang->name }}</td>
                            <td>{{ $detail->qty }}</td>
                            <td>Rp {{ number_format($detail->total_harga_jual, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <p>Total Belanja: Rp {{ number_format($transactionHeader->total_amount, 0, ',', '.') }}</p>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja!</p>
        </div>
    </div>
</body>
</html>
