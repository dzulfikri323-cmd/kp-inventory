<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body{ font-family: sans-serif; font-size:12px; }
        table{ width:100%; border-collapse:collapse; }
        th,td{ border:1px solid #ddd; padding:6px; }
        th{ background:#f5f5f5; }
    </style>
</head>
<body>
<h3>Laporan Stok Keluar</h3>
@if($from || $to)
<p>Periode: {{ $from ?? '-' }} s/d {{ $to ?? '-' }}</p>
@endif
<table>
    <thead>
    <tr>
        <th>Tanggal</th><th>Produk</th><th>Qty</th><th>Harga Jual</th><th>Catatan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stockOuts as $x)
    <tr>
        <td>{{ $x->date->format('Y-m-d') }}</td>
        <td>{{ $x->product?->name }}</td>
        <td>{{ $x->qty }}</td>
        <td>{{ $x->sell_price }}</td>
        <td>{{ $x->note }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
