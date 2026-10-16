<?php

namespace App\Http\Controllers;

use App\Models\Concerns\HasAutoNumber;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    use HasAutoNumber;

    public function index()
    {
        $pelanggans = Pelanggan::orderBy('no_pelanggan')->paginate(25);

        return view('master.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        $noPelanggan = Pelanggan::nextNoPelanggan();

        return view('master.pelanggan.create', compact('noPelanggan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tlp' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string'],
        ]);

        $validated['no_pelanggan'] = Pelanggan::nextNoPelanggan();
        $validated['is_active'] = true;

        Pelanggan::create($validated);

        return redirect()->route('master.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('master.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tlp' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $pelanggan->update($validated);

        return redirect()->route('master.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->digunakan()) {
            return back()->with('error', 'Pelanggan tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        }

        $pelanggan->delete();

        return redirect()->route('master.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }

    /**
     * AJAX / Quick-store dari modal di form penjualan
     */
    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tlp' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string'],
        ]);

        $validated['no_pelanggan'] = Pelanggan::nextNoPelanggan();
        $validated['is_active'] = true;

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'success' => true,
            'pelanggan' => $pelanggan,
        ]);
    }
}
