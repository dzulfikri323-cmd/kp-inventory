@extends('layouts.app')
@section('title','Edit Kategori')

@section('page_title', 'Edit Kategori')
@section('page_desc', 'Isi form untuk mengedit kategori.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-xl">
    <form method="POST" action="{{ route('categories.update',$category) }}" class="space-y-3">
        @csrf @method('PUT')
        <div>
            <label class="label">Nama</label>
            <input name="name" value="{{ old('name',$category->name) }}" class="input" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="label">Deskripsi</label>
            <textarea name="description" class="input" rows="3">{{ old('description',$category->description) }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn">Kembali</a>
            <button class="btn-primary">Update</button>
        </div>
    </form>
</div>

@include('partials.form-style')
@endsection
