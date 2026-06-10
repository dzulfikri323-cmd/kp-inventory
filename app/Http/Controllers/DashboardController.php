<?php

namespace App\Http\Controllers;

use App\Models\{
    Product, Category, Supplier, StockIn, StockOut
};

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalCategories= Category::count();
        $totalSuppliers = Supplier::count();
        $totalStock     = Product::sum('stock');

        $lowStocks = Product::with('category')
            ->whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        $recentIns = StockIn::with('product')
            ->latest()->limit(5)->get()
            ->map(fn($x) => (object)[
                'type' => 'in',
                'date' => $x->date,
                'product' => $x->product?->name,
                'qty' => $x->qty,
                'note' => $x->note,
            ]);

        $recentOuts = StockOut::with('product')
            ->latest()->limit(5)->get()
            ->map(fn($x) => (object)[
                'type' => 'out',
                'date' => $x->date,
                'product' => $x->product?->name,
                'qty' => $x->qty,
                'note' => $x->note,
            ]);

        $recentTransactions = $recentIns
            ->merge($recentOuts)
            ->sortByDesc('date')
            ->take(5);

        return view('dashboard.index', compact(
            'totalProducts','totalCategories','totalSuppliers','totalStock',
            'lowStocks','recentTransactions'
        ));
    }
}
