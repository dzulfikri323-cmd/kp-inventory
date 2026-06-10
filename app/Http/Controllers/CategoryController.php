<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $categories = Category::when($q, fn($s) => $s->where('name','like',"%$q%"))
            ->latest()->paginate(10)->withQueryString();

        return view('categories.index', compact('categories','q'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string'
        ]);

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success','Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string'
        ]);

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success','Kategori berhasil diubah.');
    }

    public function destroy(Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error','Staff tidak boleh menghapus master.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success','Kategori berhasil dihapus.');
    }
}
