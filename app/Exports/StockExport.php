<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping};

class StockExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with(['category','supplier'])->orderBy('name')->get();
    }

    public function headings(): array
    {
        return ['Kode','Nama','Kategori','Supplier','Unit','Harga Beli','Harga Jual','Stok','Min Stok'];
    }

    public function map($p): array
    {
        return [
            $p->code,
            $p->name,
            $p->category?->name,
            $p->supplier?->name,
            $p->unit,
            $p->buy_price,
            $p->sell_price,
            $p->stock,
            $p->min_stock,
        ];
    }
}
