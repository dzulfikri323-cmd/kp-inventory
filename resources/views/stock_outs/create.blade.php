@extends('layouts.app')
@section('title','Tambah Stok Keluar')

@section('page_title', 'Tambah Stok Keluar')
@section('page_desc', 'Isi form untuk menambahkan stok keluar.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-xl">
<form method="POST" action="{{ route('stock-outs.store') }}" class="space-y-3">
    @csrf
    <div>
        <label class="label">Produk</label>
        <select name="product_id" class="input" required>
            <option value="">-- pilih --</option>
            @foreach($products as $p)
                <option value="{{ $p->id }}" @selected(old('product_id')==$p->id)>
                    {{ $p->code }} - {{ $p->name }} (stok: {{ $p->stock }})
                </option>
            @endforeach
        </select>
        @error('product_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Qty</label>
        <input type="number" name="qty" value="{{ old('qty') }}" class="input" required min="1">
        @error('qty') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Harga Jual (opsional)</label>
        <input type="number" name="sell_price" value="{{ old('sell_price') }}" class="input">
        @error('sell_price') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Tanggal</label>
        <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" class="input" required>
        @error('date') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Catatan</label>
        <textarea name="note" class="input" rows="3">{{ old('note') }}</textarea>
        @error('note') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="flex gap-2">
        <a href="{{ route('stock-outs.index') }}" class="btn">Kembali</a>
        <button class="btn-primary">Simpan</button>
    </div>
</form>
</div>
@include('partials.form-style')
@endsection
