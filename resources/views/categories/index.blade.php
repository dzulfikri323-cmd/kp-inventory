@extends('layouts.app')
@section('title','Kategori')

@section('page_title', 'Daftar Kategori')
@section('page_desc', 'Kelola kategori barang inventaris.')

@section('content')

<div class="bg-white rounded-2xl border border-slate-200 p-4">

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
    <form class="flex gap-2">
        <input
            name="q"
            value="{{ $q }}"
            placeholder="Search kategori..."
            class="input"
        >

        <button class="btn">
            Cari
        </button>
    </form>

    <a href="{{ route('categories.create') }}" class="btn-primary">
        + Tambah
    </a>
</div>

<div class="overflow-x-auto">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th class="text-right w-40">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($categories as $c)
            <tr>
                <td class="font-medium">{{ $c->name }}</td>
                <td class="text-slate-500">{{ $c->description }}</td>

                <td class="text-right">
                    <a href="{{ route('categories.edit',$c) }}" class="btn-sm">
                        Edit
                    </a>

                    @if(auth()->user()->role == 'admin')

                    <form
                        action="{{ route('categories.destroy',$c) }}"
                        method="POST"
                        style="display:inline-block;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                                background:red;
                                color:white;
                                padding:8px 12px;
                                border:none;
                                border-radius:5px;
                                cursor:pointer;
                            "
                        >
                            Hapus
                        </button>
                    </form>

                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-slate-500 py-6">
                    Data kosong.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $categories->links() }}
</div>

</div>

@include('partials.table-style')
@endsection
