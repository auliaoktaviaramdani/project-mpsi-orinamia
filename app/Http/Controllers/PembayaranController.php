<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Catat pembayaran untuk sebuah invoice
     */
    public function store(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'jumlah'  => ['required', 'numeric', 'min:1'],
        ]);

        $sisa = $invoice->sisaTagihan();

        if ((float) $validated['jumlah'] > $sisa) {
            return back()->with('error', 'Jumlah pembayaran melebihi sisa tagihan invoice (Rp ' . number_format($sisa, 0, ',', '.') . ').');
        }

        Pembayaran::create([
            'invoice_id' => $invoice->id,
            'tanggal'    => $validated['tanggal'],
            'jumlah'     => $validated['jumlah'],
            'user_id'    => Auth::id(),
        ]);

        // Hitung ulang totals dan status di penjualan
        $invoice->load('pembayarans');
        $penjualan = $invoice->penjualan;
        $penjualan->load('invoices.pembayarans');
        $penjualan->recalculateTotalsAndStatus();

        return back()->with('success', 'Pembayaran berhasil dicatat.');
    }
}
