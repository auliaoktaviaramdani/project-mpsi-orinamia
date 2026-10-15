<?php

namespace App\Http\Controllers;

use App\Models\Concerns\HasAutoNumber;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use HasAutoNumber;

    public function index()
    {
        $suppliers = Supplier::orderBy('no_supplier')->paginate(25);

        return view('master.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        $noSupplier = Supplier::nextNoSupplier();

        return view('master.supplier.create', compact('noSupplier'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'tlp' => ['nullable', 'string', 'max:30'],
        ]);

        $validated['no_supplier'] = Supplier::nextNoSupplier();
        $validated['is_active'] = true;

        Supplier::create($validated);

        return redirect()->route('master.supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('master.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'tlp' => ['nullable', 'string', 'max:30'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $supplier->update($validated);

        return redirect()->route('master.supplier.index')
            ->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->digunakan()) {
            return back()->with('error', 'Supplier tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        }

        $supplier->delete();

        return redirect()->route('master.supplier.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }

    /**
     * AJAX / Quick-store dari modal di form penjualan/pembelian
     */
    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'tlp' => ['nullable', 'string', 'max:30'],
        ]);

        $validated['no_supplier'] = Supplier::nextNoSupplier();
        $validated['is_active'] = true;

        $supplier = Supplier::create($validated);

        return response()->json([
            'success' => true,
            'supplier' => $supplier,
        ]);
    }
}
