<?php

namespace App\Http\Controllers;

use App\Models\{StockOut, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $stockOuts = StockOut::with(['product','user'])
            ->when($q, fn($s)=>$s->whereHas('product', fn($p)=>$p->where('name','like',"%$q%")))
            ->latest()->paginate(10)->withQueryString();

        return view('stock_outs.index', compact('stockOuts','q'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock_outs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'=>'required|exists:products,id',
            'qty'=>'required|integer|min:1',
            'sell_price'=>'nullable|numeric|min:0',
            'note'=>'nullable|string',
            'date'=>'required|date',
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->find($data['product_id']);
            if ($data['qty'] > $product->stock) {
                abort(422, 'Qty melebihi stok tersedia');
            }

            $data['user_id'] = auth()->id();
            StockOut::create($data);

            $product->decrement('stock', $data['qty']);
        });

        return redirect()->route('stock-outs.index')
            ->with('success','Stok keluar berhasil disimpan.');
    }
}
