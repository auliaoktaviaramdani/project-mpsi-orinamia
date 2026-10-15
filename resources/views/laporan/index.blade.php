@extends('layouts.simorin')
@section('title', 'Laporan Keuangan & Operasional')

@php
  use App\Support\Fmt;

  $totalNominal = 0;
  $totalBayar = 0;
  $totalSisa = 0;

  if ($jenis === 'penjualan') {
      $totalNominal = $rows->sum('total');
      $totalBayar = $rows->sum('paid');
      $totalSisa = $rows->sum('balance_due');
  } elseif ($jenis === 'pembelian') {
      $totalNominal = $rows->sum('total_beli');
  } elseif ($jenis === 'piutang') {
      $totalNominal = $rows->sum('total');
      $totalBayar = $rows->sum('paid');
      $totalSisa = $rows->sum('balance_due');
  }
@endphp

@section('content')
<div style="max-width:1200px;margin:0 auto;display:flex;flex-direction:column;gap:24px;">

  <!-- Page Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;">
    <div>
      <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;color:var(--text);letter-spacing:-0.01em;">
        Laporan Keuangan & Operasional
      </h1>
      <p style="font-size:0.875rem;color:var(--muted);margin-top:4px;">
        Rekapitulasi data transaksi penjualan busana, pembelian bahan baku, dan monitoring piutang.
      </p>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
      <a href="{{ route('laporan.show', ['jenis' => $jenis, 'dari' => $dari, 'sampai' => $sampai]) }}"
         target="_blank"
         class="btn-outline"
         style="font-size:0.8125rem;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Cetak Dokumen Laporan
      </a>
    </div>
  </div>

  <!-- Filter Surface Panel -->
  <div class="panel" style="padding:20px 24px;">
    <form action="{{ route('laporan.index') }}" method="GET" style="display:flex;flex-direction:column;gap:16px;">
      
      <!-- Filter Controls Grid -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:16px;align-items:flex-end;">
        
        <!-- Jenis Laporan -->
        <div>
          <label class="form-label" for="jenis">Jenis Laporan</label>
          <select id="jenis" name="jenis" class="form-input" style="font-weight:500;">
            <option value="penjualan" {{ $jenis === 'penjualan' ? 'selected' : '' }}>Rekap Penjualan Busana</option>
            <option value="pembelian" {{ $jenis === 'pembelian' ? 'selected' : '' }}>Rekap Pembelian Bahan Baku</option>
            <option value="piutang" {{ $jenis === 'piutang' ? 'selected' : '' }}>Monitoring Piutang Pelanggan</option>
          </select>
        </div>

        <!-- Periode Dari -->
        <div>
          <label class="form-label" for="dari">Dari Tanggal</label>
          <input type="date" id="dari" name="dari" value="{{ $dari }}" class="form-input font-num" required>
        </div>

        <!-- Periode Sampai -->
        <div>
          <label class="form-label" for="sampai">Sampai Tanggal</label>
          <input type="date" id="sampai" name="sampai" value="{{ $sampai }}" class="form-input font-num" required>
        </div>

        <!-- Submit Button -->
        <div style="display:flex;gap:8px;">
          <button type="submit" class="btn-primary" style="flex:1;justify-content:center;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Tampilkan Data
          </button>
        </div>

      </div>

    </form>
  </div>

  <!-- Summary Cards -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:16px;">
    
    <!-- Total Transaksi -->
    <div class="panel" style="padding:20px;">
      <div style="font-size:0.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">
        Total Transaksi Terdata
      </div>
      <div class="font-num" style="font-size:1.625rem;font-weight:700;color:var(--text);">
        {{ number_format($rows->count(), 0, ',', '.') }}
        <span style="font-size:0.875rem;font-weight:400;color:var(--muted);">berkas</span>
      </div>
      <div style="font-size:0.75rem;color:var(--muted);margin-top:6px;">
        Periode {{ Fmt::date($dari) }} s/d {{ Fmt::date($sampai) }}
      </div>
    </div>

    <!-- Total Nominal -->
    <div class="panel" style="padding:20px;">
      <div style="font-size:0.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">
        {{ $jenis === 'pembelian' ? 'Total Pengeluaran Bahan' : 'Total Nilai Transaksi' }}
      </div>
      <div class="font-num" style="font-size:1.625rem;font-weight:700;color:var(--accent);">
        {{ Fmt::rupiah($totalNominal) }}
      </div>
      <div style="font-size:0.75rem;color:var(--muted);margin-top:6px;">
        Akumulasi nilai bruto
      </div>
    </div>

    @if($jenis !== 'pembelian')
    <!-- Sisa Piutang -->
    <div class="panel" style="padding:20px;position:relative;">
      <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:6px;">
        <span style="font-size:0.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.05em;">
          Sisa Piutang Tertunggak
        </span>
        <span style="font-size:0.6875rem;font-weight:600;padding:2px 8px;border-radius:999px;{{ $totalSisa > 0 ? 'background:rgba(220,38,38,0.1);color:#DC2626;' : 'background:rgba(22,163,74,0.1);color:#16A34A;' }}">
          {{ $totalSisa > 0 ? 'Tertunggak' : 'Semua Lunas' }}
        </span>
      </div>
      <div class="font-num" style="font-size:1.625rem;font-weight:700;color:{{ $totalSisa > 0 ? '#DC2626' : '#16A34A' }};">
        {{ Fmt::rupiah($totalSisa) }}
      </div>
      <div style="font-size:0.75rem;color:var(--muted);margin-top:6px;">
        Terbayar: <span class="font-num" style="font-weight:600;">{{ Fmt::rupiah($totalBayar) }}</span>
      </div>
    </div>
    @endif

  </div>

  <!-- Table Panel -->
  <div class="panel">
    
    <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
      <div>
        <h2 style="font-size:0.9375rem;font-weight:700;color:var(--text);">
          @if($jenis === 'penjualan')
            Rincian Penjualan Busana
          @elseif($jenis === 'pembelian')
            Rincian Pembelian Bahan Baku
          @else
            Daftar Piutang Pelanggan Belum Lunas
          @endif
        </h2>
        <span style="font-size:0.75rem;color:var(--muted);">
          Ditemukan {{ $rows->count() }} rekaman data pada rentang tanggal terpilih
        </span>
      </div>
    </div>

    @if($rows->isEmpty())
      <!-- Empty State -->
      <div style="padding:56px 24px;text-align:center;">
        <div style="width:52px;height:52px;border-radius:50%;background:var(--tint);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:var(--accent);">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
        <p style="font-size:0.9375rem;font-weight:600;color:var(--text);margin-bottom:4px;">
          Tidak ada data transaksi ditemukan
        </p>
        <p style="font-size:0.8125rem;color:var(--muted);max-width:380px;margin:0 auto;">
          Silakan sesuaikan filter tanggal atau jenis laporan di atas untuk melihat data transaksi lainnya.
        </p>
      </div>
    @else
      <div style="overflow-x:auto;">
        <table class="tbl" style="width:100%;border-collapse:collapse;text-align:left;">
          <thead>
            @if($jenis === 'penjualan')
              <tr>
                <th>No. Penjualan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th style="text-align:right;">Total Pesanan</th>
                <th style="text-align:right;">Uang Muka (DP)</th>
                <th style="text-align:right;">Pelunasan</th>
                <th style="text-align:right;">Sisa Piutang</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Aksi</th>
              </tr>
            @elseif($jenis === 'pembelian')
              <tr>
                <th>No. Pembelian</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th style="text-align:right;">Total Belanja</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Aksi</th>
              </tr>
            @else
              <tr>
                <th>No. Penjualan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>No. Telp</th>
                <th style="text-align:right;">Total Pesanan</th>
                <th style="text-align:right;">Terbayar</th>
                <th style="text-align:right;">Sisa Piutang</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Aksi</th>
              </tr>
            @endif
          </thead>
          <tbody>
            @foreach($rows as $row)
              @if($jenis === 'penjualan')
                <tr>
                  <td>
                    <span class="font-num" style="font-weight:600;color:var(--accent);">
                      {{ $row->no_jual }}
                    </span>
                  </td>
                  <td>
                    <span class="font-num" style="color:var(--muted);font-size:0.8125rem;">
                      {{ Fmt::date($row->tgl_jual) }}
                    </span>
                  </td>
                  <td style="font-weight:600;">
                    {{ $row->pelanggan->nama_pelanggan ?? 'Umum' }}
                  </td>
                  <td class="font-num" style="text-align:right;font-weight:600;">
                    {{ Fmt::rupiah($row->total_harga) }}
                  </td>
                  <td class="font-num" style="text-align:right;color:var(--muted);">
                    {{ Fmt::rupiah($row->dp) }}
                  </td>
                  <td class="font-num" style="text-align:right;color:var(--muted);">
                    {{ Fmt::rupiah($row->pelunasan) }}
                  </td>
                  <td class="font-num" style="text-align:right;font-weight:600;color:{{ $row->balance_due > 0 ? '#DC2626' : '#16A34A' }};">
                    {{ Fmt::rupiah($row->balance_due) }}
                  </td>
                  <td style="text-align:center;">
                    <span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:0.75rem;font-weight:600;
                      @if($row->status === 'LUNAS') background:#D1FAE5;color:#064E3B;
                      @elseif($row->status === 'DP_LUNAS') background:#FEF3C7;color:#78350F;
                      @elseif($row->status === 'TERKIRIM') background:#DBEAFE;color:#1E40AF;
                      @else background:#FEE2E2;color:#7F1D1D; @endif">
                      {{ $row->status_label }}
                    </span>
                  </td>
                  <td style="text-align:center;">
                    <a href="{{ route('penjualan.show', $row) }}" class="btn-outline" style="min-height:30px;padding:3px 8px;font-size:0.75rem;">
                      Lihat
                    </a>
                  </td>
                </tr>
              @elseif($jenis === 'pembelian')
                <tr>
                  <td>
                    <span class="font-num" style="font-weight:600;color:var(--accent);">
                      {{ $row->no_beli }}
                    </span>
                  </td>
                  <td>
                    <span class="font-num" style="color:var(--muted);font-size:0.8125rem;">
                      {{ Fmt::date($row->tgl_beli) }}
                    </span>
                  </td>
                  <td style="font-weight:600;">
                    {{ $row->supplier->nama_supplier ?? 'Umum' }}
                  </td>
                  <td class="font-num" style="text-align:right;font-weight:600;">
                    {{ Fmt::rupiah($row->total_beli) }}
                  </td>
                  <td style="text-align:center;">
                    <span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:0.75rem;font-weight:600;background:#D1FAE5;color:#064E3B;">
                      Selesai
                    </span>
                  </td>
                  <td style="text-align:center;">
                    <a href="{{ route('pembelian.show', $row) }}" class="btn-outline" style="min-height:30px;padding:3px 8px;font-size:0.75rem;">
                      Lihat
                    </a>
                  </td>
                </tr>
              @else
                <tr>
                  <td>
                    <span class="font-num" style="font-weight:600;color:var(--accent);">
                      {{ $row->no_jual }}
                    </span>
                  </td>
                  <td>
                    <span class="font-num" style="color:var(--muted);font-size:0.8125rem;">
                      {{ Fmt::date($row->tgl_jual) }}
                    </span>
                  </td>
                  <td style="font-weight:600;">
                    {{ $row->pelanggan->nama_pelanggan ?? 'Umum' }}
                  </td>
                  <td class="font-num" style="font-size:0.8125rem;color:var(--muted);">
                    {{ $row->pelanggan->telp ?? '-' }}
                  </td>
                  <td class="font-num" style="text-align:right;">
                    {{ Fmt::rupiah($row->total_harga) }}
                  </td>
                  <td class="font-num" style="text-align:right;color:var(--muted);">
                    {{ Fmt::rupiah($row->dp + $row->pelunasan) }}
                  </td>
                  <td class="font-num" style="text-align:right;font-weight:700;color:#DC2626;">
                    {{ Fmt::rupiah($row->balance_due) }}
                  </td>
                  <td style="text-align:center;">
                    <span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:0.75rem;font-weight:600;background:#FEE2E2;color:#7F1D1D;">
                      {{ $row->status_label }}
                    </span>
                  </td>
                  <td style="text-align:center;">
                    <a href="{{ route('penjualan.show', $row) }}" class="btn-outline" style="min-height:30px;padding:3px 8px;font-size:0.75rem;">
                      Kelola
                    </a>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
          <tfoot>
            <tr style="background:var(--tint);font-weight:700;">
              @if($jenis === 'penjualan')
                <td colspan="3" style="padding:12px 16px;">TOTAL KESELURUHAN</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($totalNominal) }}</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($rows->sum('dp')) }}</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($rows->sum('pelunasan')) }}</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;color:{{ $totalSisa > 0 ? '#DC2626' : '#16A34A' }};">{{ Fmt::rupiah($totalSisa) }}</td>
                <td colspan="2"></td>
              @elseif($jenis === 'pembelian')
                <td colspan="3" style="padding:12px 16px;">TOTAL PEMBELIAN BAHAN</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($totalNominal) }}</td>
                <td colspan="2"></td>
              @else
                <td colspan="4" style="padding:12px 16px;">TOTAL PIUTANG AKTIF</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($totalNominal) }}</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;">{{ Fmt::rupiah($totalBayar) }}</td>
                <td class="font-num" style="text-align:right;padding:12px 16px;color:#DC2626;">{{ Fmt::rupiah($totalSisa) }}</td>
                <td colspan="2"></td>
              @endif
            </tr>
          </tfoot>
        </table>
      </div>
    @endif

  </div>

</div>
@endsection
