<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        /* CSS untuk styling nota */
    </style>
</head>
<body>
    <h1>Nota Transaksi</h1>
    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
    <p><strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d/m/Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($transaksiDetails as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->produk->harga_jual }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->produk->harga_jual * $detail->jumlah }}</td>
                </tr>
            @endforeach --}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total Harga:</strong></td>
                <td>{{ $transaksi->total_harga }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
