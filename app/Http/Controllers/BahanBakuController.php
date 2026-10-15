<?php

namespace App\Http\Controllers;

use App\Models\Concerns\HasAutoNumber;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    use HasAutoNumber;

    public function index()
    {
        $bahans = BahanBaku::orderBy('no_bahan')->paginate(25);
        return view('master.bahan.index', compact('bahans'));
    }

    public function create()
    {
        $noBahan = BahanBaku::nextNoBahan();
        return view('master.bahan.create', compact('noBahan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:100'],
            'satuan'     => ['required', 'string', 'max:25'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['no_bahan']  = BahanBaku::nextNoBahan();
        $validated['is_active'] = true;

        BahanBaku::create($validated);

        return redirect()->route('master.bahan.index')
            ->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function edit(BahanBaku $bahanBaku)
    {
        return view('master.bahan.edit', compact('bahanBaku'));
    }

    public function update(Request $request, BahanBaku $bahanBaku)
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:100'],
            'satuan'     => ['required', 'string', 'max:25'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $bahanBaku->update($validated);

        return redirect()->route('master.bahan.index')
            ->with('success', 'Bahan baku berhasil diperbarui.');
    }

    public function destroy(BahanBaku $bahanBaku)
    {
        if ($bahanBaku->digunakan()) {
            return back()->with('error', 'Bahan baku tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        }

        $bahanBaku->delete();

        return redirect()->route('master.bahan.index')
            ->with('success', 'Bahan baku berhasil dihapus.');
    }
}
