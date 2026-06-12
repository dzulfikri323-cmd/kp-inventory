<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category, Supplier, StockIn};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $categoryId = $request->category_id;

        $categories = Category::orderBy('name')->get();

        $products = Product::with(['category', 'supplier'])
            ->when($q, fn($s) =>
                $s->where('name', 'like', "%$q%")
                  ->orWhere('code', 'like', "%$q%")
            )
            ->when($categoryId, fn($s) =>
                $s->where('category_id', $categoryId)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact(
            'products',
            'q',
            'categories',
            'categoryId'
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.create', compact(
            'categories',
            'suppliers'
        ));
    }

    private function generateCode(): string
    {
        $last = Product::orderBy('id', 'desc')->first();

        $num = $last
            ? ((int) Str::after($last->code, 'PRD-')) + 1
            : 1;

        return 'PRD-' . str_pad((string) $num, 4, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        $data['code'] = $this->generateCode();
        $data['stock'] = $data['stock'] ?? 0;
        $data['min_stock'] = $data['min_stock'] ?? 0;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product = Product::create($data);

        if ($product->stock > 0) {
            StockIn::create([
                'product_id' => $product->id,
                'qty'        => $product->stock,
                'buy_price'  => $product->buy_price,
                'note'       => null,
                'date'       => now()->toDateString(),
                'user_id'    => auth()->id(),
            ]);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'supplier']);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.edit', compact(
            'product',
            'categories',
            'suppliers'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        $data['stock'] = $data['stock'] ?? $product->stock;
        $data['min_stock'] = $data['min_stock'] ?? $product->min_stock;

        if ($request->hasFile('photo')) {

            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $data['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diubah.');
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with(
                'error',
                'Staff tidak boleh menghapus master.'
            );
        }

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}