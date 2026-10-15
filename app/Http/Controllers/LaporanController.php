<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Support\Fmt;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $firstOfMonth = now()->startOfMonth()->toDateString();

        return view('laporan.show', [
            'dari'  => $firstOfMonth,
            'sampai'=> $today,
            'jenis' => 'penjualan',
            'rows'  => collect(),
        ]);
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            'jenis'  => ['required', 'in:penjualan,pembelian,piutang'],
            'dari'   => ['required', 'date'],
            'sampai' => ['required', 'date', 'gte:dari'],
        ]);

        $jenis  = $validated['jenis'];
        $dari   = $validated['dari'];
        $sampai = $validated['sampai'];

        $rows = match ($jenis) {
            'penjualan' => Penjualan::with('pelanggan')
                ->whereBetween('tgl_jual', [$dari, $sampai])
                ->orderBy('tgl_jual')
                ->get(),

            'pembelian' => Pembelian::with('supplier')
                ->whereBetween('tgl_beli', [$dari, $sampai])
                ->orderBy('tgl_beli')
                ->get(),

            'piutang' => Penjualan::with('pelanggan')
                ->whereIn('status', ['BELUM_BAYAR', 'DP_LUNAS', 'LUNAS'])
                ->where('balance_due', '>', 0)
                ->whereBetween('tgl_jual', [$dari, $sampai])
                ->orderBy('tgl_jual')
                ->get(),
        };

        return view('laporan.show', compact('jenis', 'dari', 'sampai', 'rows'));
    }
}
