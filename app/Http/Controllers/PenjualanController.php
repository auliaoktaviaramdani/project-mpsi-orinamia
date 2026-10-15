<?php

namespace App\Http\Controllers;

use App\Models\Concerns\HasAutoNumber;
use App\Models\DetailPenjualan;
use App\Models\Invoice;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    use HasAutoNumber;

    /**
     * Daftar penjualan (Meja Kerja 60/40)
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'ALL');

        $penjualans = Penjualan::with(['pelanggan', 'user', 'invoices'])
            ->byStatus($status)
            ->orderByDesc('tgl_jual')
            ->paginate(25)
            ->withQueryString();

        $pelanggans = Pelanggan::where('is_active', true)->orderBy('nama')->get();

        return view('penjualan.index', compact('penjualans', 'pelanggans', 'status'));
    }

    /**
     * Detail pesanan (Lembar Rincian Pesanan)
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['pelanggan', 'user', 'details', 'invoices.pembayarans']);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Form buat pesanan baru
     */
    public function create()
    {
        $pelanggans = Pelanggan::where('is_active', true)->orderBy('nama')->get();
        $noJual = Penjualan::nextNoPenjualan();
        $today = now()->toDateString();
        $defaultDP = 50;

        return view('penjualan.create', compact('pelanggans', 'noJual', 'today', 'defaultDP'));
    }

    /**
     * Simpan pesanan baru beserta invoice DP dan Pelunasan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pelanggan,id'],
            'tgl_jual' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.nama_item' => ['required', 'string', 'max:150'],
            'items.*.ukuran' => ['nullable', 'string', 'max:50'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.harga_satuan' => ['required', 'numeric', 'min:0'],
            'dp_persen' => ['required', 'numeric', 'min:1', 'max:100'],
            'dp_jatuh_tempo' => ['required', 'date'],
            'ln_jatuh_tempo' => ['required', 'date'],
        ]);

        DB::transaction(function () use ($validated) {
            // Hitung total
            $total = 0;
            foreach ($validated['items'] as $item) {
                $total += (float) $item['qty'] * (float) $item['harga_satuan'];
            }

            $period = now()->format('Ym');
            $noJual = Penjualan::nextNoPenjualan($period);

            $penjualan = Penjualan::create([
                'no_jual' => $noJual,
                'pelanggan_id' => $validated['pelanggan_id'],
                'user_id' => Auth::id(),
                'tgl_jual' => $validated['tgl_jual'],
                'total' => $total,
                'paid' => 0,
                'balance_due' => $total,
                'status' => 'BELUM_BAYAR',
            ]);

            // Detail item
            foreach ($validated['items'] as $item) {
                $subtotal = (float) $item['qty'] * (float) $item['harga_satuan'];
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'nama_item' => $item['nama_item'],
                    'ukuran' => $item['ukuran'] ?? null,
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $subtotal,
                ]);
            }

            // Invoice DP
            $dpPersen = (float) $validated['dp_persen'];
            $dpJumlah = round($total * ($dpPersen / 100), 2);
            $lnJumlah = $total - $dpJumlah;

            $noDP = Penjualan::nextNoInvoiceDP($period);
            Invoice::create([
                'penjualan_id' => $penjualan->id,
                'jenis' => 'DP',
                'nomor' => $noDP,
                'jumlah' => $dpJumlah,
                'jatuh_tempo' => $validated['dp_jatuh_tempo'],
                'status' => 'BELUM_BAYAR',
            ]);

            // Invoice Pelunasan
            $noLN = Penjualan::nextNoInvoicePelunasan($period);
            Invoice::create([
                'penjualan_id' => $penjualan->id,
                'jenis' => 'PELUNASAN',
                'nomor' => $noLN,
                'jumlah' => $lnJumlah,
                'jatuh_tempo' => $validated['ln_jatuh_tempo'],
                'status' => 'BELUM_BAYAR',
            ]);
        });

        return redirect()->route('penjualan.index')
            ->with('success', 'Pesanan berhasil dicatat beserta Invoice DP dan Invoice Pelunasan.');
    }

    /**
     * Tandai pesanan sebagai TERKIRIM (hanya jika LUNAS)
     */
    public function tandaiTerkirim(Penjualan $penjualan)
    {
        if ($penjualan->status !== 'LUNAS') {
            return back()->with('error', 'Pesanan hanya bisa ditandai Terkirim jika status sudah LUNAS.');
        }

        $penjualan->update(['status' => 'TERKIRIM']);

        return back()->with('success', 'Status pesanan diperbarui menjadi TERKIRIM.');
    }
}
