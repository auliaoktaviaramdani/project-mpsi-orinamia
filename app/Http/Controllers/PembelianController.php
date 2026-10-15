<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Concerns\HasAutoNumber;
use App\Models\DetailBeli;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    use HasAutoNumber;

    public function index()
    {
        $pembelians = Pembelian::with(['supplier', 'user', 'details.bahan'])
            ->orderByDesc('tgl_beli')
            ->paginate(25);

        return view('pembelian.index', compact('pembelians'));
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load(['supplier', 'user', 'details.bahan']);

        return view('pembelian.show', compact('pembelian'));
    }

    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->orderBy('nama')->get();
        $bahans = BahanBaku::where('is_active', true)->orderBy('nama_bahan')->get();
        $noBeli = Pembelian::nextNoPembelian();
        $today = now()->toDateString();

        return view('pembelian.create', compact('suppliers', 'bahans', 'noBeli', 'today'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => ['required', 'exists:supplier,id'],
            'no_faktur' => ['nullable', 'string', 'max:50'],
            'tgl_beli' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.bahan_id' => ['required', 'exists:bahan_baku,id'],
            'items.*.qty' => ['required', 'numeric', 'min:0.01'],
            'items.*.harga_satuan_saat_transaksi' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated) {
            $total = 0;
            foreach ($validated['items'] as $item) {
                $total += (float) $item['qty'] * (float) $item['harga_satuan_saat_transaksi'];
            }

            $noBeli = Pembelian::nextNoPembelian();

            $pembelian = Pembelian::create([
                'no_beli' => $noBeli,
                'supplier_id' => $validated['supplier_id'],
                'user_id' => Auth::id(),
                'no_faktur' => $validated['no_faktur'] ?? null,
                'tgl_beli' => $validated['tgl_beli'],
                'total_beli' => $total,
            ]);

            foreach ($validated['items'] as $item) {
                $subtotal = (float) $item['qty'] * (float) $item['harga_satuan_saat_transaksi'];
                DetailBeli::create([
                    'pembelian_id' => $pembelian->id,
                    'bahan_id' => $item['bahan_id'],
                    'qty' => $item['qty'],
                    'harga_satuan_saat_transaksi' => $item['harga_satuan_saat_transaksi'],
                    'subtotal' => $subtotal,
                ]);
            }
        });

        return redirect()->route('pembelian.index')
            ->with('success', 'Pembelian bahan berhasil dicatat.');
    }

    public function cetak(Pembelian $pembelian)
    {
        $pembelian->load(['supplier', 'user', 'details.bahan']);

        return view('pembelian.cetak', compact('pembelian'));
    }
}
