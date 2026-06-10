<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    CategoryController,
    SupplierController,
    ProductController,
    StockInController,
    StockOutController,
    ReportController
};

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {

    // ✅ Semua user login (admin & staff) boleh akses dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Transaksi: admin & staff boleh
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('stock-ins', StockInController::class)->only(['index','create','store']);
        Route::resource('stock-outs', StockOutController::class)->only(['index','create','store']);

        // ✅ Laporan: admin & staff boleh lihat
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('stock', [ReportController::class, 'stock'])->name('stock');
            Route::get('stock-ins', [ReportController::class, 'stockIns'])->name('stockIns');
            Route::get('stock-outs', [ReportController::class, 'stockOuts'])->name('stockOuts');
        });
    });

    // 🔒 Master data: ADMIN ONLY
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('products', ProductController::class);

        // 🔒 Export laporan: ADMIN ONLY
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('stock/pdf', [ReportController::class, 'stockPdf'])->name('stock.pdf');
            Route::get('stock/excel', [ReportController::class, 'stockExcel'])->name('stock.excel');

            Route::get('stock-ins/pdf', [ReportController::class, 'stockInsPdf'])->name('stockIns.pdf');
            Route::get('stock-ins/excel', [ReportController::class, 'stockInsExcel'])->name('stockIns.excel');

            Route::get('stock-outs/pdf', [ReportController::class, 'stockOutsPdf'])->name('stockOuts.pdf');
            Route::get('stock-outs/excel', [ReportController::class, 'stockOutsExcel'])->name('stockOuts.excel');
        });
    });

});

require __DIR__.'/auth.php';
