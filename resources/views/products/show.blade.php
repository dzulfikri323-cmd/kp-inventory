@extends('layouts.app')
@section('title','Detail Produk')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-3xl">
    <div class="flex gap-4">
        <div>
            @if($product->photo)
                <img src="{{ asset('storage/'.$product->photo) }}" class="w-40 h-40 object-cover rounded-xl">
            @else
                <div class="w-40 h-40 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">No Photo</div>
            @endif
        </div>
        <div class="flex-1 space-y-2 text-sm">
            <div><span class="text-slate-500">Kode:</span> <b>{{ $product->code }}</b></div>
            <div><span class="text-slate-500">Nama:</span> <b>{{ $product->name }}</b></div>
            <div><span class="text-slate-500">Kategori:</span> {{ $product->category?->name }}</div>
            <div><span class="text-slate-500">Supplier:</span> {{ $product->supplier?->name ?? '-' }}</div>
            <div><span class="text-slate-500">Unit:</span> {{ $product->unit }}</div>
            <div><span class="text-slate-500">Harga Beli:</span> {{ number_format($product->buy_price,0,',','.') }}</div>
            <div><span class="text-slate-500">Harga Jual:</span> {{ number_format($product->sell_price,0,',','.') }}</div>
            <div><span class="text-slate-500">Stok:</span> {{ $product->stock }}</div>
            <div><span class="text-slate-500">Min Stok:</span> {{ $product->min_stock }}</div>
        </div>
    </div>

    <div class="mt-4 text-sm text-slate-600 whitespace-pre-line">
        {{ $product->description }}
    </div>

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn">Kembali</a>
    </div>
</div>

@include('partials.form-style')
@endsection
