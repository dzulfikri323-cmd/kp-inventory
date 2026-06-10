@extends('layouts.app')
@section('title','Tambah Produk')

@section('page_title', 'Tambah Produk')
@section('page_desc', 'Isi form untuk menambahkan produk baru.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-3xl">
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf

    <div>
        <label class="label">Kategori</label>
        <select name="category_id" class="input" required>
            <option value="">-- pilih --</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Supplier (opsional)</label>
        <select name="supplier_id" class="input">
            <option value="">-- tanpa supplier --</option>
            @foreach($suppliers as $s)
                <option value="{{ $s->id }}" @selected(old('supplier_id')==$s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
        @error('supplier_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Nama Produk</label>
        <input name="name" value="{{ old('name') }}" class="input" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Unit</label>
        <input name="unit" value="{{ old('unit','') }}" class="input" required>
        @error('unit') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Harga Beli</label>
        <input type="number" name="buy_price" value="{{ old('buy_price',0) }}" class="input" required>
        @error('buy_price') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Harga Jual</label>
        <input type="number" name="sell_price" value="{{ old('sell_price',0) }}" class="input" required>
        @error('sell_price') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Stok Awal</label>
        <input type="number" name="stock" value="{{ old('stock',0) }}" class="input">
        @error('stock') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="label">Min Stok</label>
        <input type="number" name="min_stock" value="{{ old('min_stock',0) }}" class="input">
        @error('min_stock') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="label">Foto</label>
        <input type="file" name="photo" class="input">
        @error('photo') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="label">Deskripsi</label>
        <textarea name="description" rows="3" class="input">{{ old('description') }}</textarea>
        @error('description') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="md:col-span-2 flex gap-2">
        <a href="{{ route('products.index') }}" class="btn">Kembali</a>
        <button class="btn-primary">Simpan</button>
    </div>
</form>
</div>
@include('partials.form-style')
@endsection
