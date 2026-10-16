<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private function getRows(string $jenis, string $dari, string $sampai)
    {
        return match ($jenis) {
            'penjualan' => Penjualan::with('pelanggan')
                ->whereBetween('tgl_jual', [$dari, $sampai])
                ->orderBy('tgl_jual', 'desc')
                ->get(),

            'pembelian' => Pembelian::with('supplier')
                ->whereBetween('tgl_beli', [$dari, $sampai])
                ->orderBy('tgl_beli', 'desc')
                ->get(),

            'piutang' => Penjualan::with('pelanggan')
                ->whereIn('status', ['BELUM_BAYAR', 'DP_LUNAS', 'LUNAS'])
                ->where('balance_due', '>', 0)
                ->whereBetween('tgl_jual', [$dari, $sampai])
                ->orderBy('tgl_jual', 'desc')
                ->get(),

            default => collect(),
        };
    }

    public function index(Request $request)
    {
        $today = now()->toDateString();
        $firstOfMonth = now()->startOfMonth()->toDateString();

        $jenis = $request->input('jenis', 'penjualan');
        $dari = $request->input('dari', $firstOfMonth);
        $sampai = $request->input('sampai', $today);

        if (! in_array($jenis, ['penjualan', 'pembelian', 'piutang'])) {
            $jenis = 'penjualan';
        }

        $rows = $this->getRows($jenis, $dari, $sampai);

        return view('laporan.index', compact('jenis', 'dari', 'sampai', 'rows'));
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            'jenis' => ['required', 'in:penjualan,pembelian,piutang'],
            'dari' => ['required', 'date'],
            'sampai' => ['required', 'date', 'gte:dari'],
        ]);

        $jenis = $validated['jenis'];
        $dari = $validated['dari'];
        $sampai = $validated['sampai'];

        $rows = $this->getRows($jenis, $dari, $sampai);

        return view('laporan.cetak', compact('jenis', 'dari', 'sampai', 'rows'));
    }
}
