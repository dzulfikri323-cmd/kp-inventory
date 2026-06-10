@extends('layouts.app')
@section('title','Transaksi Stok Masuk')

@section('page_title', 'Transaksi Stok Masuk')
@section('page_desc', 'Kelola transaksi stok masuk barang inventaris.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4">
    <div class="flex flex-col md:flex-row md:justify-between gap-3 mb-4">
        <form class="flex gap-2">
            <input name="q" value="{{ $q }}" placeholder="Search produk..." class="input">
            <button class="btn">Cari</button>
        </form>
        <a href="{{ route('stock-ins.create') }}" class="btn-primary">+ Tambah Stok Masuk</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
            <tr>
                <th>Tanggal</th><th>Produk</th><th class="text-right">Qty</th>
                <th class="text-right">Harga Beli</th><th>Catatan</th><th>User</th>
            </tr>
            </thead>
            <tbody>
            @forelse($stockIns as $x)
                <tr>
                    <td>{{ $x->date->format('d/m/Y') }}</td>
                    <td class="font-medium">{{ $x->product?->name }}</td>
                    <td class="text-right">{{ $x->qty }}</td>
                    <td class="text-right">{{ number_format($x->buy_price ?? 0,0,',','.') }}</td>
                    <td class="text-slate-500">{{ $x->note }}</td>
                    <td>{{ $x->user?->name }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-slate-500 py-6">Belum ada transaksi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $stockIns->links() }}</div>
</div>

@include('partials.table-style')
@endsection
