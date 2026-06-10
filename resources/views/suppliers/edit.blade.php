@extends('layouts.app')
@section('title','Edit Supplier')

@section('page_title', 'Edit Supplier')
@section('page_desc', 'Isi form untuk mengedit data supplier.')
@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4 max-w-xl">
    <form method="POST" action="{{ route('suppliers.update',$supplier) }}" class="space-y-3">
        @csrf @method('PUT')
        <div>
            <label class="label">Nama</label>
            <input name="name" value="{{ old('name',$supplier->name) }}" class="input" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="label">Telepon</label>
            <input name="phone" value="{{ old('phone',$supplier->phone) }}" class="input">
            @error('phone') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="label">Alamat</label>
            <textarea name="address" class="input" rows="3">{{ old('address',$supplier->address) }}</textarea>
            @error('address') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="flex gap-2">
            <a href="{{ route('suppliers.index') }}" class="btn">Kembali</a>
            <button class="btn-primary">Update</button>
        </div>
    </form>
</div>
@include('partials.form-style')
@endsection
