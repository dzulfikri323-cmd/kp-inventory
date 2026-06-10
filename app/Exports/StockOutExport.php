<?php

namespace App\Exports;

use App\Models\StockOut;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping};

class StockOutExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(public ?string $from, public ?string $to) {}

    public function collection()
    {
        return StockOut::with('product')
            ->when($this->from, fn($q)=>$q->whereDate('date','>=',$this->from))
            ->when($this->to, fn($q)=>$q->whereDate('date','<=',$this->to))
            ->orderBy('date','desc')->get();
    }

    public function headings(): array
    {
        return ['Tanggal','Produk','Qty','Harga Jual','Catatan','User'];
    }

    public function map($x): array
    {
        return [
            $x->date->format('Y-m-d'),
            $x->product?->name,
            $x->qty,
            $x->sell_price,
            $x->note,
            $x->user?->name,
        ];
    }
}
