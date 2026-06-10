@extends('layouts.app')
@section('title','Laporan Stok Keluar')

@section('page_title', 'Laporan Stok Keluar')
@section('page_desc', 'Kelola laporan stok keluar barang inventaris.')

@section('content')
<div class="page-padding space-y-4">

    {{-- FILTER TANGGAL --}}
    <div class="card p-4">
        <form method="GET" action="{{ route('reports.stockOuts') }}"
              class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">

            <div class="form-group">
                <label class="label">Dari Tanggal</label>
                <input type="date" name="from" value="{{ request('from') }}" class="input">
            </div>

            <div class="form-group">
                <label class="label">Sampai Tanggal</label>
                <input type="date" name="to" value="{{ request('to') }}" class="input">
            </div>

            <div class="flex gap-2">
                <button class="btn-primary w-full md:w-auto">Filter</button>
                <a href="{{ route('reports.stockOuts') }}" class="btn-secondary w-full md:w-auto text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- TABLE STOK KELUAR --}}
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga Jual</th>
                    <th class="text-right">Subtotal</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockOuts as $o)
                @php
                    $sell = $o->sell_price ?? $o->product->sell_price;
                    $subtotal = $sell * $o->qty;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($o->date)->format('d/m/Y') }}</td>
                    <td class="font-medium">{{ $o->product?->name }}</td>
                    <td class="text-right">{{ $o->qty }}</td>
                    <td class="text-right">Rp {{ number_format($sell, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td class="text-slate-500">{{ $o->note ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-slate-500 py-6">
                        Data tidak ditemukan di rentang tanggal itu.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- TOTAL --}}
    <div class="text-sm text-slate-600 flex flex-wrap gap-3">
        <div>
            Total qty (hasil filter):
            <span class="font-semibold">{{ $totalQty }}</span>
        </div>
        <div>
            Total nilai (hasil filter):
            <span class="font-semibold">Rp {{ number_format($totalValue, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- BUTTON EXPORT --}}
    <div class="flex justify-end gap-2">
        <a href="{{ route('reports.stockOuts.pdf', request()->query()) }}" class="btn-secondary">
            Export PDF
        </a>
        <a href="{{ route('reports.stockOuts.excel', request()->query()) }}" class="btn-primary">
            Export Excel
        </a>
    </div>

</div>
@endsection
