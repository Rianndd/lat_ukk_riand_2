<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            /* Atur padding untuk memberikan jarak antar sel */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            /* Warna latar belakang untuk header */
        }

        tfoot td {
            background-color: #f2f2f2;
            /* Warna latar belakang untuk baris footer */
        }
    </style>
</head>

<body onload="window.print()">
    <center>
        <h1>Detail Transaksi</h1>
    </center>
    <hr>
    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>

    <!-- Tampilkan detail transaksi -->
    <p><strong>Nama Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan }}</p>

    <!-- Tampilkan detail transaksiDetail -->
    <h2>Detail Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->transaksiDetails as $key => $detail)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="2" style="text-align: right;"><strong>Total Harga:</strong></td>
            <td>{{ number_format($transaksi->total_harga) }}</td>
        </tfoot>
    </table>
    <!-- Tambahkan JavaScript untuk mengarahkan kembali ke halaman indeks setelah mencetak atau menutup tab PDF -->
    <script>
        window.onafterprint = function() {
            window.location.href = "{{ route('transaksi.index') }}";
        };
    </script>
</body>

</html>
