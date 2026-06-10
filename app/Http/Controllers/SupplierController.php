<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $suppliers = Supplier::when($q, fn($s)=>$s->where('name','like',"%$q%"))
            ->latest()->paginate(10)->withQueryString();

        return view('suppliers.index', compact('suppliers','q'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'nullable|string|max:50',
            'address'=>'nullable|string'
        ]);

        Supplier::create($data);

        return redirect()->route('suppliers.index')
            ->with('success','Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'nullable|string|max:50',
            'address'=>'nullable|string'
        ]);

        $supplier->update($data);

        return redirect()->route('suppliers.index')
            ->with('success','Supplier berhasil diubah.');
    }

    public function destroy(Supplier $supplier)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error','Staff tidak boleh menghapus master.');
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success','Supplier berhasil dihapus.');
    }
}
