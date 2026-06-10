@extends('layouts.app')
@section('title','Produk')

@section('page_title', 'Daftar Produk')
@section('page_desc', 'Kelola produk barang inventaris.')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 p-4">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 mb-4">
        <form class="flex flex-col md:flex-row gap-2 w-full">
            <input name="q" value="{{ $q }}" placeholder="Search kode/nama..." class="input md:w-64">

            <select name="category_id" class="input md:w-56">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected($categoryId==$c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>

            <button class="btn md:w-24">Filter</button>
        </form>

        <a href="{{ route('products.create') }}" class="btn-primary">
            + Tambah
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th class="text-right">Harga Beli</th>
                    <th class="text-right">Harga Jual</th>
                    <th class="text-right">Stok</th>
                    <th class="text-right">Min</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($products as $p)
                <tr>
                   <td>
  @if($p->photo)
    <img
        src="{{ asset('storage/'.$p->photo) }}"
        alt="{{ $p->name }}"
        style="
            width:70px;
            height:70px;
            object-fit:cover;
            border-radius:8px;
        "
    >
@else
    <div class="w-10 h-10 bg-slate-100 rounded flex items-center justify-center text-xs text-slate-400">
        N/A
    </div>
@endif
</td>

                    <td>{{ $p->code }}</td>

                    <td>
                        {{ $p->name }}

                        @if($p->is_low_stock)
                            <span class="badge badge-red">
                                Menipis
                            </span>
                        @endif
                    </td>

                    <td>{{ $p->category?->name }}</td>
                    <td>{{ $p->supplier?->name ?? '-' }}</td>

                    <td class="text-right">
                        {{ number_format($p->buy_price,0,',','.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($p->sell_price,0,',','.') }}
                    </td>

                    <td class="text-right">
                        {{ $p->stock }}
                    </td>

                    <td class="text-right">
                        {{ $p->min_stock }}
                    </td>

                    <td>
                        <a href="{{ route('products.show',$p) }}">
                            Detail
                        </a>

                        <a href="{{ route('products.edit',$p) }}">
                            Edit
                        </a>

                        @if(auth()->user()->role == 'admin')

                        <form
                            action="{{ route('products.destroy',$p) }}"
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
                    <td colspan="10" class="text-center py-6">
                        Data kosong.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>

@include('partials.table-style')
@endsection