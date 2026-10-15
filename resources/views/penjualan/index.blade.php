@extends('layouts.simorin')
@section('title', 'Daftar Penjualan')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;">Meja Kerja Penjualan</h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">
      Daftar pesanan dan lembar rincian invoice. Pilih baris untuk melihat detail.
    </p>
  </div>
  @if(auth()->user()->role === 'admin')
  <a href="{{ route('penjualan.create') }}" class="btn-primary" id="btn-pesanan-baru">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
    </svg>
    Pesanan Baru
  </a>
  @endif
</div>

<div style="display:grid;grid-template-columns:1fr;gap:20px;">
  @if($penjualans->isEmpty())
  <!-- Empty State -->
  <div class="panel" style="padding:64px 32px;text-align:center;" id="empty-state">
    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="var(--muted)" stroke-width="1" style="margin:0 auto 16px;">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
    </svg>
    <p class="font-editorial" style="font-size:1.375rem;font-weight:600;margin-bottom:8px;">Belum Ada Pesanan</p>
    <p style="font-size:0.8375rem;color:var(--muted);max-width:360px;margin:0 auto 20px;">
      Catat pesanan pakaian pelanggan untuk menerbitkan Invoice DP dan Invoice Pelunasan secara otomatis.
    </p>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('penjualan.create') }}" class="btn-primary">Buat Pesanan Pertama</a>
    @endif
  </div>
  @else

  <!-- Filter Status -->
  <div style="display:flex;align-items:center;flex-wrap:wrap;gap:10px;">
    <span style="font-size:0.8125rem;color:var(--muted);font-weight:600;">Filter:</span>
    @foreach(['ALL' => 'Semua', 'BELUM_BAYAR' => 'Belum Bayar', 'DP_LUNAS' => 'DP Lunas', 'LUNAS' => 'Lunas', 'TERKIRIM' => 'Terkirim'] as $val => $label)
    <a href="{{ route('penjualan.index', ['status' => $val]) }}"
       class="btn-outline"
       style="font-size:0.75rem;min-height:34px;padding:4px 12px;{{ $status === $val ? 'background:var(--accent);color:#fff;border-color:var(--accent);' : '' }}">
      {{ $label }}
    </a>
    @endforeach
    <span style="font-size:0.75rem;color:var(--muted);margin-left:4px;">
      {{ $penjualans->total() }} pesanan
    </span>
  </div>

  <!-- Table -->
  <div class="panel" style="overflow-x:auto;" id="tabel-penjualan">
    <table class="tbl" style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          <th>No. Pesanan</th>
          <th>Tanggal</th>
          <th>Pelanggan</th>
          <th style="text-align:right;">Total</th>
          <th style="text-align:right;">Terbayar</th>
          <th style="text-align:right;">Sisa Piutang</th>
          <th>Status</th>
          <th style="text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($penjualans as $p)
        <tr style="cursor:pointer;" onclick="window.location='{{ route('penjualan.show', $p) }}'">
          <td>
            <a href="{{ route('penjualan.show', $p) }}" class="font-num" style="font-weight:600;color:var(--accent);text-decoration:none;font-size:0.8125rem;"
               onclick="event.stopPropagation();">
              {{ $p->no_jual }}
            </a>
          </td>
          <td class="font-num" style="font-size:0.8rem;white-space:nowrap;">{{ \App\Support\Fmt::tglPendek($p->tgl_jual) }}</td>
          <td>
            <div style="font-weight:600;font-size:0.8375rem;">{{ $p->pelanggan->nama }}</div>
            <div class="font-num" style="font-size:0.7rem;color:var(--muted);">{{ $p->pelanggan->no_pelanggan }}</div>
          </td>
          <td class="font-num" style="text-align:right;font-weight:600;font-size:0.8375rem;">
            {{ \App\Support\Fmt::rp($p->total) }}
          </td>
          <td class="font-num" style="text-align:right;font-size:0.8375rem;color:#064E3B;">
            {{ \App\Support\Fmt::rp($p->paid) }}
          </td>
          <td class="font-num" style="text-align:right;font-size:0.8375rem;font-weight:{{ $p->balance_due > 0 ? '700' : '400' }};color:{{ $p->balance_due > 0 ? '#7F1D1D' : 'var(--muted)' }};">
            {{ \App\Support\Fmt::rp($p->balance_due) }}
          </td>
          <td>
            @php
              $badgeClass = match($p->status) {
                'BELUM_BAYAR' => 'badge-belum',
                'DP_LUNAS'   => 'badge-dp',
                'LUNAS'      => 'badge-lunas',
                'TERKIRIM'   => 'badge-kirim',
                default      => 'badge-belum',
              };
              $badgeLabel = match($p->status) {
                'BELUM_BAYAR' => 'Belum Bayar',
                'DP_LUNAS'   => 'DP Lunas',
                'LUNAS'      => 'Lunas',
                'TERKIRIM'   => 'Terkirim',
                default      => $p->status,
              };
            @endphp
            <span class="{{ $badgeClass }}" style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;white-space:nowrap;">
              {{ $badgeLabel }}
            </span>
          </td>
          <td style="text-align:center;" onclick="event.stopPropagation();">
            <a href="{{ route('penjualan.show', $p) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 10px;">
              Detail
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($penjualans->hasPages())
  <div style="display:flex;align-items:center;justify-content:center;gap:6px;flex-wrap:wrap;">
    <a href="{{ $penjualans->previousPageUrl() }}" class="page-link {{ $penjualans->onFirstPage() ? 'disabled' : '' }}">
      &laquo;
    </a>
    @foreach($penjualans->getUrlRange(1, $penjualans->lastPage()) as $page => $url)
    <a href="{{ $url }}" class="page-link {{ $penjualans->currentPage() === $page ? 'active' : '' }}">
      {{ $page }}
    </a>
    @endforeach
    <a href="{{ $penjualans->nextPageUrl() }}" class="page-link {{ ! $penjualans->hasMorePages() ? 'disabled' : '' }}">
      &raquo;
    </a>
  </div>
  @endif

  @endif
</div>
@endsection
