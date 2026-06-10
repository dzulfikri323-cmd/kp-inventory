@extends('layouts.app')
@section('title','Tambah Supplier')

@section('page_title', 'Tambah Supplier')
@section('page_desc', 'Isi form untuk menambahkan supplier baru.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-xl">
    <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-3">
        @csrf
        <div>
            <label class="label">Nama</label>
            <input
                name="name"
                value="{{ old('name') }}"
                class="input"
                required
                placeholder="Tambahkan Supplier..."
            >
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="label">Telepon</label>
            <input
                name="phone"
                value="{{ old('phone') }}"
                class="input"
                required
                placeholder="Tambahkan Nomor..."
            >
            @error('name') <div class="error">{{ $message }}</div> @enderror
           
        </div>
        <div>
            <label class="label">Alamat</label>
            <textarea name="address" class="input" rows="3">{{ old('address') }}</textarea>
            @error('address') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2">
            <a href="{{ route('suppliers.index') }}" class="btn">Kembali</a>
            <button class="btn-primary">Simpan</button>
        </div>
    </form>
</div>
@include('partials.form-style')
@endsection
