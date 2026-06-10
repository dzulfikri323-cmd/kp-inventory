<?php

namespace App\Exports;

use App\Models\StockIn;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping};

class StockInExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(public ?string $from, public ?string $to) {}

    public function collection()
    {
        return StockIn::with('product')
            ->when($this->from, fn($q)=>$q->whereDate('date','>=',$this->from))
            ->when($this->to, fn($q)=>$q->whereDate('date','<=',$this->to))
            ->orderBy('date','desc')->get();
    }

    public function headings(): array
    {
        return ['Tanggal','Produk','Qty','Harga Beli','Catatan','User'];
    }

    public function map($x): array
    {
        return [
            $x->date->format('Y-m-d'),
            $x->product?->name,
            $x->qty,
            $x->buy_price,
            $x->note,
            $x->user?->name,
        ];
    }
}
