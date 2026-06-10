<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\StockExport;
use App\Exports\StockInExport;
use App\Exports\StockOutExport;


class ReportController extends Controller
{
    /* =========================================================
       1) LAPORAN STOK PRODUK
       ========================================================= */

    // View laporan stok
public function stock(Request $request)
{
    $from = $request->from;
    $to   = $request->to;

    $products = Product::with(['category', 'supplier'])
        ->when($from, fn($q) => $q->whereDate('created_at', '>=', $from))
        ->when($to, fn($q) => $q->whereDate('created_at', '<=', $to))
        ->orderBy('name')
        ->get();

    $totalStock = $products->sum('stock');

    return view('reports.stock', compact('products', 'totalStock', 'from', 'to'));
}


    // Export PDF stok
    public function stockPdf()
    {
        $products = Product::with(['category', 'supplier'])
            ->orderBy('name')
            ->get();

        return Pdf::loadView('reports.stock_pdf', compact('products'))
            ->setPaper('a4', 'portrait')
            ->download('laporan-stok-produk.pdf');
    }

    // Export Excel stok
    public function stockExcel()
    {
        return Excel::download(new StockExport, 'laporan-stok-produk.xlsx');
    }


    /* =========================================================
       2) LAPORAN STOK MASUK (FILTER DATE RANGE)
       ========================================================= */

    // View laporan stok masuk
    public function stockIns(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $stockIns = StockIn::with(['product.category', 'user'])
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->orderBy('date', 'desc')
            ->get();

        $totalQty = $stockIns->sum('qty');
        $totalValue = $stockIns->sum(fn($i) => ($i->buy_price ?? $i->product->buy_price) * $i->qty);

        return view('reports.stock_ins', compact(
            'stockIns',
            'from',
            'to',
            'totalQty',
            'totalValue'
        ));
    }

    // Export PDF stok masuk
    public function stockInsPdf(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $stockIns = StockIn::with(['product.category', 'user'])
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->orderBy('date', 'desc')
            ->get();

        return Pdf::loadView('reports.stock_ins_pdf', compact('stockIns', 'from', 'to'))
            ->setPaper('a4', 'portrait')
            ->download('laporan-stok-masuk.pdf');
    }

    // Export Excel stok masuk
   public function stockInsExcel(Request $request)
{
    $from = $request->from;
    $to   = $request->to;

    return Excel::download(
        new StockInExport($from, $to),
        'laporan-stok-masuk.xlsx'
    );
}



    /* =========================================================
       3) LAPORAN STOK KELUAR (FILTER DATE RANGE)
       ========================================================= */

    // View laporan stok keluar
    public function stockOuts(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $stockOuts = StockOut::with(['product.category', 'user'])
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->orderBy('date', 'desc')
            ->get();

        $totalQty = $stockOuts->sum('qty');
        $totalValue = $stockOuts->sum(fn($o) => ($o->sell_price ?? $o->product->sell_price) * $o->qty);

        return view('reports.stock_outs', compact(
            'stockOuts',
            'from',
            'to',
            'totalQty',
            'totalValue'
        ));
    }

    // Export PDF stok keluar
    public function stockOutsPdf(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $stockOuts = StockOut::with(['product.category', 'user'])
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->orderBy('date', 'desc')
            ->get();

        return Pdf::loadView('reports.stock_outs_pdf', compact('stockOuts', 'from', 'to'))
            ->setPaper('a4', 'portrait')
            ->download('laporan-stok-keluar.pdf');
    }

    // Export Excel stok keluar
   public function stockOutsExcel(Request $request)
{
    $from = $request->from;
    $to   = $request->to;

    return Excel::download(
        new StockOutExport($from, $to),
        'laporan-stok-keluar.xlsx'
    );
}

}
