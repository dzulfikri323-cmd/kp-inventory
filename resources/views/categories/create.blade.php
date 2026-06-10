@extends('layouts.app')
@section('title','Tambah Kategori')

@section('page_title', 'Tambah Kategori')
@section('page_desc', 'Isi form untuk menambahkan kategori baru.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-xl">
    <form method="POST" action="{{ route('categories.store') }}" class="space-y-3">
        @csrf
        <div>
            <label class="label">Nama</label> 
            <input
                name="name"
                value="{{ old('name') }}"
                class="input"
                required
                placeholder="Tambahkan Kategori..."
            >
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="label">Deskripsi</label>
            <textarea
                name="description"
                class="input"
                rows="3"
                placeholder="Deskripsi Singkat..."
            >{{ old('description') }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn">Kembali</a>
            <button class="btn-primary">Simpan</button>
        </div>
    </form>
</div>

@include('partials.form-style')
@endsection
