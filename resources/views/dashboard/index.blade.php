@extends('layouts.app')

@section('page_title','Dashboard')

@section('content')

<!-- HERO -->

<div style="background:white; padding:20px; border-radius:12px; display:flex; align-items:center; gap:20px;">


<img src="{{ asset('images/logo.png') }}" style="width:120px;">

<div>
    <h2>FUJI PHOTOCOPY</h2>
    <p>Sistem Inventaris Barang</p>
</div>


</div>

<!-- CARD -->

<div style="display:grid; grid-template-columns:repeat(5,1fr); gap:15px; margin-top:20px;">

<div style="background:white; padding:20px; border-radius:10px;">
    <h4>Total Produk</h4>
    <h2>{{ $totalProducts }}</h2>
</div>

<div style="background:white; padding:20px; border-radius:10px;">
    <h4>Total Kategori</h4>
    <h2>{{ $totalCategories }}</h2>
</div>

<div style="background:white; padding:20px; border-radius:10px;">
    <h4>Total Supplier</h4>
    <h2>{{ $totalSuppliers }}</h2>
</div>

<div style="background:white; padding:20px; border-radius:10px;">
    <h4>Total Stok</h4>
    <h2>{{ $totalStock }}</h2>
</div>

<div style="background:#fef2f2; padding:20px; border-radius:10px; border:1px solid #fecaca;">
    <h4 style="color:#dc2626;">Stok Menipis</h4>
    <h2 style="color:#dc2626;">{{ $lowStocks->count() }}</h2>
</div>


</div>

@if($lowStocks->count() > 0)

<div style="
    margin-top:20px;
    background:#fef2f2;
    border:1px solid #fecaca;
    border-radius:12px;
    padding:20px;
">


<h3 style="margin-top:0;color:#dc2626;">
    ⚠️ Produk Perlu Direstok
</h3>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th style="text-align:left;padding:10px;">Produk</th>
            <th style="text-align:left;padding:10px;">Kategori</th>
            <th style="text-align:left;padding:10px;">Stok Saat Ini</th>
            <th style="text-align:left;padding:10px;">Minimal Stok</th>
        </tr>
    </thead>

    <tbody>
    @foreach($lowStocks as $item)
        <tr>
            <td style="padding:10px;">{{ $item->name }}</td>
            <td style="padding:10px;">{{ $item->category?->name }}</td>
            <td style="padding:10px;color:red;font-weight:bold;">
                {{ $item->stock }}
            </td>
            <td style="padding:10px;">
                {{ $item->min_stock }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


</div>

@else

<div style="
    margin-top:20px;
    background:#ecfdf5;
    border:1px solid #bbf7d0;
    border-radius:12px;
    padding:20px;
">
    <h3 style="color:#16a34a; margin:0;">
        ✅ Semua stok masih aman
    </h3>
</div>

@endif

@endsection
