@extends('layouts.simorin')
@section('title', 'Dashboard')

@section('content')
<div style="margin-bottom:24px;display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;color:var(--text);">Dashboard</h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">
      Ringkasan keuangan Orinamia Daily Wear &bull; {{ \App\Support\Fmt::tgl(now()) }}
    </p>
  </div>
  <a href="{{ route('home') }}" target="_blank" class="btn-outline" style="font-size:0.8125rem;display:inline-flex;align-items:center;gap:8px;">
    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10"></circle>
      <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
    </svg>
    Lihat Web Profil PT Cahaya Binar Berlian &rarr;
  </a>
</div>
  
<!-- Summary Cards -->
<section style="display:grid;grid-template-columns:repeat(12,1fr);gap:16px;margin-bottom:24px;" aria-label="Ringkasan Keuangan">

  <!-- Focal Card: Total Piutang Aktif [ReactBits Spotlight + Bento Architecture] -->
  <div class="panel spotlight-card" style="grid-column:span 12;" id="card-piutang">
    <div style="display:grid;grid-template-columns:1fr auto;gap:16px;padding:24px;">
      <div>
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
          <span style="font-size:0.75rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:0.06em;">
            Fokus Piutang Usaha
          </span>
          @if($invoiceMenunggu > 0)
          <span style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;background:#FEE2E2;color:#7F1D1D;">
            <span class="anim-counter" data-val="{{ $invoiceMenunggu }}">{{ $invoiceMenunggu }}</span> Invoice Menunggu
          </span>
          @else
          <span style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;background:#D1FAE5;color:#064E3B;">
            Semua Lunas
          </span>
          @endif
        </div>
        <h2 class="font-editorial" style="font-size:1.35rem;font-weight:600;margin-bottom:16px;">
          Tagihan Pelanggan <span class="shiny-text">Belum Lunas</span>
        </h2>
        <div style="display:flex;align-items:baseline;gap:8px;margin-bottom:16px;">
          <span style="font-size:0.875rem;font-weight:600;color:var(--muted);">Rp</span>
          <span class="font-num anim-counter" data-val="{{ $totalPiutang }}" style="font-size:2.5rem;font-weight:700;letter-spacing:-0.02em;color:var(--text);">
            {{ number_format($totalPiutang, 0, ',', '.') }}
          </span>
          <span style="font-size:0.8rem;color:var(--muted);margin-left:6px;">
            dari total pesanan Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
          </span>
        </div>

        <!-- Progress Bar -->
        <div style="space-y:6px;">
          <div style="display:flex;justify-content:space-between;font-size:0.75rem;margin-bottom:6px;">
            <span style="color:var(--muted);">
              Sudah Diterima:
              <strong class="font-num" style="color:#064E3B;">
                Rp {{ number_format($totalPaid, 0, ',', '.') }} ({{ $paidPercent }}%)
              </strong>
            </span>
            <span style="color:var(--muted);">
              Sisa Piutang:
              <strong class="font-num" style="color:#7F1D1D;">
                Rp {{ number_format($totalPiutang, 0, ',', '.') }} ({{ $unpaidPercent }}%)
              </strong>
            </span>
          </div>
          <div style="width:100%;height:10px;border-radius:99px;background:var(--tint);overflow:hidden;display:flex;">
            <div style="height:100%;background:#6E387A;width:{{ $paidPercent }}%;transition:width 500ms;border-radius:99px 0 0 99px;"></div>
            <div style="height:100%;background:#F391EC;opacity:0.6;width:{{ $unpaidPercent }}%;"></div>
          </div>
        </div>
      </div>

      <!-- Icon -->
      <div style="display:flex;align-items:center;justify-content:center;width:72px;height:72px;border-radius:12px;background:var(--tint);flex-shrink:0;">
        <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="#6E387A" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/>
        </svg>
      </div>
    </div>
  </div>

  <!-- Card Penjualan & Pembelian Bento Grid -->
  <div class="panel spotlight-card" style="grid-column:span 12;" id="card-penjualan">
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:0;">

      <!-- Penjualan -->
      <div style="padding:22px;border-right:1px solid var(--border);">
        <span style="font-size:0.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.04em;">Total Penjualan</span>
        <h3 class="font-editorial" style="font-size:1.15rem;font-weight:600;margin:4px 0 12px;">Pesanan Make-to-Order</h3>
        <div style="margin-bottom:12px;">
          <span style="font-size:0.875rem;font-weight:600;color:var(--muted);">Rp </span>
          <span class="font-num anim-counter" data-val="{{ $totalPenjualan }}" style="font-size:1.75rem;font-weight:700;color:var(--text);">
            {{ number_format($totalPenjualan, 0, ',', '.') }}
          </span>
        </div>
        <div style="border-top:1.5px dashed #D5CEE2;padding-top:12px;display:flex;justify-content:space-between;font-size:0.75rem;color:var(--muted);">
          <span><strong class="font-num anim-counter" data-val="{{ $jumlahPesanan }}">{{ $jumlahPesanan }}</strong> Pesanan Aktif</span>
          <span>Spesifikasi Custom</span>
        </div>
      </div>

      <!-- Pembelian -->
      <div style="padding:22px;">
        <span style="font-size:0.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.04em;">Pembelian Bahan Baku</span>
        <h3 class="font-editorial" style="font-size:1.15rem;font-weight:600;margin:4px 0 12px;">Belanja Kain &amp; Aksesoris</h3>
        <div style="margin-bottom:12px;">
          <span style="font-size:0.875rem;font-weight:600;color:var(--muted);">Rp </span>
          <span class="font-num anim-counter" data-val="{{ $totalPembelian }}" style="font-size:1.75rem;font-weight:700;color:var(--text);">
            {{ number_format($totalPembelian, 0, ',', '.') }}
          </span>
        </div>
        <div style="border-top:1.5px dashed #D5CEE2;padding-top:12px;display:flex;justify-content:space-between;font-size:0.75rem;color:var(--muted);">
          <span><strong class="font-num anim-counter" data-val="{{ $jumlahFaktur }}">{{ $jumlahFaktur }}</strong> Faktur Supplier</span>
          <span>Snapshot Harga HPP</span>
        </div>
      </div>
    </div>
  </div>

</section>

<!-- Quick Links -->
<section aria-label="Akses Cepat">
  <h2 class="font-editorial" style="font-size:1.125rem;font-weight:600;margin-bottom:14px;">Akses Cepat</h2>
  <div style="display:flex;flex-wrap:wrap;gap:10px;">
    <a href="{{ route('penjualan.index') }}" class="btn-outline">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
      </svg>
      Daftar Penjualan
    </a>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('penjualan.create') }}" class="btn-primary">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
      </svg>
      Pesanan Baru
    </a>
    @endif
    <a href="{{ route('pembelian.index') }}" class="btn-outline">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
      </svg>
      Pembelian Bahan
    </a>
    <a href="{{ route('laporan.index') }}" class="btn-outline">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      Laporan
    </a>
  </div>
</section>
@endsection
