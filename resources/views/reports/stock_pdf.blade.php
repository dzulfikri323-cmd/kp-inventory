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
<h3>Laporan Stok Produk</h3>
<table>
    <thead>
    <tr>
        <th>Kode</th><th>Produk</th><th>Kategori</th><th>Supplier</th>
        <th>Unit</th><th>Stok</th><th>Min Stok</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $p)
    <tr>
        <td>{{ $p->code }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category?->name }}</td>
        <td>{{ $p->supplier?->name ?? '-' }}</td>
        <td>{{ $p->unit }}</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->min_stock }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
