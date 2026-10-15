<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pembelian;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        // Total piutang aktif (balance_due pada penjualan yang belum TERKIRIM)
        $totalPiutang = Penjualan::whereIn('status', ['BELUM_BAYAR', 'DP_LUNAS', 'LUNAS'])
            ->sum('balance_due');

        $totalPenjualan = Penjualan::sum('total');
        $totalPaid = Penjualan::sum('paid');
        $totalPembelian = Pembelian::sum('total_beli');

        // Jumlah invoice yang belum lunas
        $invoiceMenunggu = Invoice::where('status', 'BELUM_BAYAR')->count();

        $paidPercent = $totalPenjualan > 0 ? round(($totalPaid / $totalPenjualan) * 100, 1) : 0;
        $unpaidPercent = 100 - $paidPercent;

        $jumlahPesanan = Penjualan::count();
        $jumlahFaktur = Pembelian::count();

        return view('dashboard', compact(
            'totalPiutang',
            'totalPenjualan',
            'totalPaid',
            'totalPembelian',
            'invoiceMenunggu',
            'paidPercent',
            'unpaidPercent',
            'jumlahPesanan',
            'jumlahFaktur',
        ));
    }
}
