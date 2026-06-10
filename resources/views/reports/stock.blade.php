@extends('layouts.app')
@section('title','Laporan Stok Produk')

@section('page_title', 'Laporan Stok Produk')
@section('page_desc', 'Kelola laporan stok produk barang inventaris.')
@section('content')
<div class="page-padding space-y-4">


    {{-- FILTER TANGGAL --}}
    <div class="card p-4">
        <form method="GET" action="{{ route('reports.stock') }}"
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
                <a href="{{ route('reports.stock') }}" class="btn-secondary w-full md:w-auto text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- TABLE STOK --}}
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th class="text-right">Stok</th>
                    <th class="text-right">Min</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td>{{ $p->code }}</td>
                    <td class="font-medium">{{ $p->name }}</td>
                    <td>{{ $p->category?->name }}</td>
                    <td>{{ $p->supplier?->name ?? '-' }}</td>
                    <td class="text-right">{{ $p->stock }}</td>
                    <td class="text-right">{{ $p->min_stock }}</td>
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
    <div class="text-sm text-slate-600">
        Total stok (hasil filter): <span class="font-semibold">{{ $totalStock }}</span>
    </div>

    {{-- BUTTON EXPORT --}}
    <div class="flex justify-end gap-2">
        <a href="{{ route('reports.stock.pdf', request()->query()) }}" class="btn-secondary">
            Export PDF
        </a>
        <a href="{{ route('reports.stock.excel', request()->query()) }}" class="btn-primary">
            Export Excel
        </a>
    </div>

</div>
@endsection
