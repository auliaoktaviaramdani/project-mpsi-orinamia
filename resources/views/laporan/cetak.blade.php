@php
  use App\Support\Fmt;

  $totalNominal = 0;
  $totalBayar = 0;
  $totalSisa = 0;

  if ($jenis === 'penjualan') {
      $totalNominal = $rows->sum('total_harga');
      $totalBayar = $rows->sum('dp') + $rows->sum('pelunasan');
      $totalSisa = $rows->sum('balance_due');
  } elseif ($jenis === 'pembelian') {
      $totalNominal = $rows->sum('total_beli');
  } elseif ($jenis === 'piutang') {
      $totalNominal = $rows->sum('total_harga');
      $totalBayar = $rows->sum('dp') + $rows->sum('pelunasan');
      $totalSisa = $rows->sum('balance_due');
  }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Laporan - {{ strtoupper($jenis) }} - Orinamia Daily Wear</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Newsreader:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 11pt;
      color: #2D2B33;
      background: #FAF9FC;
      padding: 24px;
    }
    .print-sheet {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid #E4DFEC;
      border-radius: 8px;
      padding: 36px 40px;
    }
    .font-editorial { font-family: 'Newsreader', Georgia, serif; }
    .font-num {
      font-family: 'JetBrains Mono', monospace;
      font-variant-numeric: tabular-nums;
      white-space: nowrap;
    }
    .report-table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 9.5pt;
    }
    .report-table th {
      background: #F4EFFA;
      color: #635D73;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 8pt;
      letter-spacing: 0.05em;
      padding: 8px 10px;
      border-top: 1px solid #E4DFEC;
      border-bottom: 1.5px solid #6E387A;
    }
    .report-table td {
      padding: 8px 10px;
      border-bottom: 1px solid #E4DFEC;
    }
    .report-table tfoot td {
      background: #FAF9FC;
      font-weight: 700;
      border-top: 1.5px solid #6E387A;
      border-bottom: 2px solid #6E387A;
      padding: 10px;
    }
    .btn-print {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 18px;
      background: #6E387A;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.875rem;
      cursor: pointer;
      text-decoration: none;
    }
    @media print {
      body { background: #fff; padding: 0; }
      .print-sheet { border: none; padding: 0; max-width: 100%; }
      .no-print { display: none !important; }
    }
  </style>
</head>
<body>

  <!-- Floating action bar for printing -->
  <div class="no-print" style="max-width:900px;margin:0 auto 16px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <button onclick="window.close()" style="background:#fff;border:1px solid #E4DFEC;padding:8px 16px;border-radius:6px;cursor:pointer;font-weight:600;font-size:0.875rem;color:#635D73;">
      &larr; Tutup Jendela
    </button>
    <button onclick="window.print()" class="btn-print">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
      </svg>
      Cetak Sekarang (Print)
    </button>
  </div>

  <div class="print-sheet">
    
    <!-- Header Surat / Dokumen -->
    <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid #6E387A;padding-bottom:16px;margin-bottom:20px;">
      <div style="display:flex;align-items:center;gap:14px;">
        <div style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #E4DFEC;display:flex;align-items:center;justify-content:center;padding:2px;">
          <svg width="40" height="40" viewBox="0 0 100 100" fill="none" role="img" aria-label="Logo Orinamia">
            <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
            <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
            <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
            <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
          </svg>
        </div>
        <div>
          <div style="font-size:1.25rem;font-weight:700;letter-spacing:0.12em;line-height:1.1;">
            <span style="color:#E074D8;">ORI</span><span style="color:#9B78E6;">NAMIA</span>
          </div>
          <div style="font-size:0.6875rem;letter-spacing:0.25em;color:#635D73;font-weight:600;">DAILY WEAR ATELIER</div>
          <div style="font-size:0.75rem;color:#635D73;margin-top:2px;">Sistem Informasi Manajemen Operasional (SIMORIN)</div>
        </div>
      </div>
      <div style="text-align:right;">
        <div class="font-editorial" style="font-size:1.375rem;font-weight:600;color:#2D2B33;">
          @if($jenis === 'penjualan')
            Laporan Penjualan Busana
          @elseif($jenis === 'pembelian')
            Laporan Pembelian Bahan
          @else
            Laporan Monitoring Piutang
          @endif
        </div>
        <div style="font-size:0.8125rem;color:#635D73;margin-top:2px;">
          Periode: <strong class="font-num">{{ Fmt::date($dari) }}</strong> s/d <strong class="font-num">{{ Fmt::date($sampai) }}</strong>
        </div>
        <div style="font-size:0.75rem;color:#635D73;margin-top:2px;">
          Dicetak: <span class="font-num">{{ now()->translatedFormat('d F Y H:i') }}</span>
        </div>
      </div>
    </div>

    <!-- Tabel Data Laporan -->
    <table class="report-table">
      <thead>
        @if($jenis === 'penjualan')
          <tr>
            <th style="width:5%;">No</th>
            <th style="width:18%;">No. Transaksi</th>
            <th style="width:12%;">Tanggal</th>
            <th style="width:25%;">Pelanggan</th>
            <th style="text-align:right;width:15%;">Total Pesanan</th>
            <th style="text-align:right;width:12%;">Terbayar</th>
            <th style="text-align:right;width:13%;">Sisa Piutang</th>
          </tr>
        @elseif($jenis === 'pembelian')
          <tr>
            <th style="width:5%;">No</th>
            <th style="width:22%;">No. Pembelian</th>
            <th style="width:18%;">Tanggal</th>
            <th style="width:30%;">Supplier</th>
            <th style="text-align:right;width:25%;">Total Pengeluaran</th>
          </tr>
        @else
          <tr>
            <th style="width:5%;">No</th>
            <th style="width:18%;">No. Transaksi</th>
            <th style="width:12%;">Tanggal</th>
            <th style="width:25%;">Pelanggan</th>
            <th style="width:15%;">Kontak</th>
            <th style="text-align:right;width:12%;">Total</th>
            <th style="text-align:right;width:13%;">Sisa Piutang</th>
          </tr>
        @endif
      </thead>
      <tbody>
        @forelse($rows as $idx => $row)
          @if($jenis === 'penjualan')
            <tr>
              <td style="text-align:center;">{{ $idx + 1 }}</td>
              <td class="font-num" style="font-weight:600;">{{ $row->no_jual }}</td>
              <td class="font-num">{{ Fmt::date($row->tgl_jual) }}</td>
              <td>{{ $row->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
              <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($row->total_harga) }}</td>
              <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($row->dp + $row->pelunasan) }}</td>
              <td class="font-num" style="text-align:right;font-weight:600;color:{{ $row->balance_due > 0 ? '#B91C1C' : '#047857' }};">
                {{ Fmt::rupiah($row->balance_due) }}
              </td>
            </tr>
          @elseif($jenis === 'pembelian')
            <tr>
              <td style="text-align:center;">{{ $idx + 1 }}</td>
              <td class="font-num" style="font-weight:600;">{{ $row->no_beli }}</td>
              <td class="font-num">{{ Fmt::date($row->tgl_beli) }}</td>
              <td>{{ $row->supplier->nama_supplier ?? 'Umum' }}</td>
              <td class="font-num" style="text-align:right;font-weight:600;">{{ Fmt::rupiah($row->total_beli) }}</td>
            </tr>
          @else
            <tr>
              <td style="text-align:center;">{{ $idx + 1 }}</td>
              <td class="font-num" style="font-weight:600;">{{ $row->no_jual }}</td>
              <td class="font-num">{{ Fmt::date($row->tgl_jual) }}</td>
              <td>{{ $row->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
              <td class="font-num">{{ $row->pelanggan->telp ?? '-' }}</td>
              <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($row->total_harga) }}</td>
              <td class="font-num" style="text-align:right;font-weight:700;color:#B91C1C;">
                {{ Fmt::rupiah($row->balance_due) }}
              </td>
            </tr>
          @endif
        @empty
          <tr>
            <td colspan="7" style="text-align:center;padding:24px;color:#635D73;">
              Tidak ada rekaman transaksi pada periode tanggal ini.
            </td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        @if($jenis === 'penjualan')
          <tr>
            <td colspan="4" style="text-align:left;">TOTAL KESELURUHAN ({{ $rows->count() }} Transaksi)</td>
            <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($totalNominal) }}</td>
            <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($totalBayar) }}</td>
            <td class="font-num" style="text-align:right;color:{{ $totalSisa > 0 ? '#B91C1C' : '#047857' }};">{{ Fmt::rupiah($totalSisa) }}</td>
          </tr>
        @elseif($jenis === 'pembelian')
          <tr>
            <td colspan="4" style="text-align:left;">TOTAL PENGELUARAN ({{ $rows->count() }} Transaksi)</td>
            <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($totalNominal) }}</td>
          </tr>
        @else
          <tr>
            <td colspan="5" style="text-align:left;">TOTAL PIUTANG AKTIF ({{ $rows->count() }} Pelanggan)</td>
            <td class="font-num" style="text-align:right;">{{ Fmt::rupiah($totalNominal) }}</td>
            <td class="font-num" style="text-align:right;color:#B91C1C;">{{ Fmt::rupiah($totalSisa) }}</td>
          </tr>
        @endif
      </tfoot>
    </table>

    <!-- Tanda Tangan Pengesahan -->
    <div style="display:flex;justify-content:space-between;margin-top:40px;page-break-inside:avoid;">
      <div>
        <div style="font-size:8pt;color:#635D73;">Catatan:</div>
        <div style="font-size:8pt;color:#635D73;max-width:320px;">
          Dokumen laporan ini dicetak secara otomatis dari Sistem Informasi Orinamia (SIMORIN) dan sah sebagai bahan pertanggungjawaban operasional atelier.
        </div>
      </div>
      <div style="text-align:center;min-width:200px;">
        <div style="font-size:8.5pt;color:#635D73;">Bandung, {{ now()->translatedFormat('d F Y') }}</div>
        <div style="font-size:8.5pt;font-weight:600;margin-top:2px;">Pemilik / Penanggung Jawab</div>
        <div style="height:55px;"></div>
        <div style="font-weight:700;text-decoration:underline;">( Orinamia Daily Wear )</div>
        <div style="font-size:8pt;color:#635D73;">Atelier Management</div>
      </div>
    </div>

  </div>

</body>
</html>
