<?php

namespace App\Http\Controllers;

use App\Models\{StockIn, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $stockIns = StockIn::with(['product','user'])
            ->when($q, fn($s)=>$s->whereHas('product', fn($p)=>$p->where('name','like',"%$q%")))
            ->latest()->paginate(10)->withQueryString();

        return view('stock_ins.index', compact('stockIns','q'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock_ins.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'=>'required|exists:products,id',
            'qty'=>'required|integer|min:1',
            'buy_price'=>'nullable|numeric|min:0',
            'note'=>'nullable|string',
            'date'=>'required|date',
        ]);

        DB::transaction(function () use ($data) {
            $data['user_id'] = auth()->id();
            StockIn::create($data);

            $product = Product::lockForUpdate()->find($data['product_id']);
            $product->increment('stock', $data['qty']);
        });

        return redirect()->route('stock-ins.index')
            ->with('success','Stok masuk berhasil disimpan.');
    }
}
