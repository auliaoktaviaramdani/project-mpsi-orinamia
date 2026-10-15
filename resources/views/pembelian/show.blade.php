@extends('layouts.simorin')
@section('title', 'Detail Pembelian - ' . $pembelian->no_beli)

@php use App\Support\Fmt; @endphp

@section('content')
<div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
  <a href="{{ route('pembelian.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">
    &larr; Kembali
  </a>
  <div style="flex:1;">
    <h1 class="font-num" style="font-size:1.5rem;font-weight:700;">{{ $pembelian->no_beli }}</h1>
    <p style="font-size:0.8125rem;color:var(--muted);margin-top:4px;">
      Supplier: <strong>{{ $pembelian->supplier->nama }}</strong>
      @if($pembelian->no_faktur) &bull; Faktur: <span class="font-num">{{ $pembelian->no_faktur }}</span> @endif
      &bull; Tgl. Beli: {{ Fmt::tgl($pembelian->tgl_beli) }}
      &bull; Dicatat: {{ $pembelian->created_at->format('d/m/Y H:i') }}
      &bull; Oleh: {{ $pembelian->user->name }}
    </p>
  </div>
  <a href="{{ route('pembelian.cetak', $pembelian) }}" class="btn-primary" target="_blank" id="btn-cetak-pembelian">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
    </svg>
    Cetak Bukti
  </a>
</div>

<div class="panel" style="overflow-x:auto;">
  <table class="tbl" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>Bahan Baku</th>
        <th>Satuan</th>
        <th style="text-align:right;">Qty</th>
        <th style="text-align:right;">Harga Saat Transaksi</th>
        <th style="text-align:right;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pembelian->details as $d)
      <tr>
        <td>
          <div style="font-weight:600;">{{ $d->bahan->nama_bahan }}</div>
          <div class="font-num" style="font-size:0.75rem;color:var(--muted);">{{ $d->bahan->no_bahan }}</div>
        </td>
        <td style="color:var(--muted);">{{ $d->bahan->satuan }}</td>
        <td class="font-num" style="text-align:right;">{{ number_format($d->qty, 2, ',', '.') }}</td>
        <td class="font-num" style="text-align:right;">{{ Fmt::rp($d->harga_satuan_saat_transaksi) }}</td>
        <td class="font-num" style="text-align:right;font-weight:700;">{{ Fmt::rp($d->subtotal) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="padding:16px 20px;background:var(--tint);border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
    <span style="font-size:0.8375rem;color:var(--muted);">Total Pembelian</span>
    <span class="font-num" style="font-size:1.25rem;font-weight:700;">{{ Fmt::rp($pembelian->total_beli) }}</span>
  </div>
</div>
@endsection
