<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Tampilkan halaman cetak invoice
     */
    public function cetak(Invoice $invoice)
    {
        $invoice->load(['penjualan.pelanggan', 'penjualan.details', 'penjualan.user', 'pembayarans']);

        return view('invoice.cetak', compact('invoice'));
    }
}
