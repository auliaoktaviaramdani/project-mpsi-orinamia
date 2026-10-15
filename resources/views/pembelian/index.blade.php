@extends('layouts.simorin')
@section('title', 'Pembelian Bahan Baku')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;">Pembelian Bahan Baku</h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">
      Riwayat pembelian kain dan aksesoris. Harga disimpan sebagai snapshot saat transaksi.
    </p>
  </div>
  @if(auth()->user()->role === 'admin')
  <a href="{{ route('pembelian.create') }}" class="btn-primary" id="btn-pembelian-baru">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
    </svg>
    Catat Pembelian
  </a>
  @endif
</div>

@if($pembelians->isEmpty())
<div class="panel" style="padding:64px;text-align:center;">
  <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="var(--muted)" stroke-width="1" style="margin:0 auto 16px;">
    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
  </svg>
  <p class="font-editorial" style="font-size:1.375rem;font-weight:600;margin-bottom:8px;">Belum Ada Pembelian</p>
  <p style="font-size:0.8375rem;color:var(--muted);max-width:360px;margin:0 auto 20px;">
    Catat pembelian bahan baku dari supplier untuk melacak pengeluaran produksi.
  </p>
  @if(auth()->user()->role === 'admin')
  <a href="{{ route('pembelian.create') }}" class="btn-primary">Catat Pembelian Pertama</a>
  @endif
</div>
@else
<div class="panel" style="overflow-x:auto;">
  <table class="tbl" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>No. Beli</th>
        <th>No. Faktur</th>
        <th>Supplier</th>
        <th>Tgl. Beli</th>
        <th>Dicatat</th>
        <th>Rincian Bahan</th>
        <th style="text-align:right;">Total Beli</th>
        <th style="text-align:center;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pembelians as $p)
      <tr>
        <td>
          <a href="{{ route('pembelian.show', $p) }}" class="font-num"
             style="font-weight:700;color:var(--accent);text-decoration:none;font-size:0.8125rem;">
            {{ $p->no_beli }}
          </a>
        </td>
        <td class="font-num" style="font-size:0.8rem;">{{ $p->no_faktur ?: '-' }}</td>
        <td style="font-weight:600;font-size:0.8375rem;">{{ $p->supplier->nama }}</td>
        <td class="font-num" style="font-size:0.8rem;white-space:nowrap;">{{ \App\Support\Fmt::tglPendek($p->tgl_beli) }}</td>
        <td class="font-num" style="font-size:0.75rem;color:var(--muted);white-space:nowrap;">{{ $p->created_at->format('d/m/Y H:i') }}</td>
        <td style="font-size:0.75rem;max-width:240px;">
          @foreach($p->details as $d)
          <span>{{ $d->bahan->nama_bahan }}
            <span class="font-num">({{ number_format($d->qty, 2, ',', '.') }} {{ $d->bahan->satuan }} @ {{ \App\Support\Fmt::rp($d->harga_satuan_saat_transaksi) }})</span>
          </span>
          @if(!$loop->last), @endif
          @endforeach
        </td>
        <td class="font-num" style="text-align:right;font-weight:700;">{{ \App\Support\Fmt::rp($p->total_beli) }}</td>
        <td style="text-align:center;white-space:nowrap;">
          <a href="{{ route('pembelian.show', $p) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 8px;">Detail</a>
          <a href="{{ route('pembelian.cetak', $p) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 8px;" target="_blank">Cetak</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@if($pembelians->hasPages())
<div style="display:flex;align-items:center;justify-content:center;gap:6px;flex-wrap:wrap;margin-top:16px;">
  <a href="{{ $pembelians->previousPageUrl() }}" class="page-link {{ $pembelians->onFirstPage() ? 'disabled' : '' }}">&laquo;</a>
  @foreach($pembelians->getUrlRange(1, $pembelians->lastPage()) as $page => $url)
  <a href="{{ $url }}" class="page-link {{ $pembelians->currentPage() === $page ? 'active' : '' }}">{{ $page }}</a>
  @endforeach
  <a href="{{ $pembelians->nextPageUrl() }}" class="page-link {{ ! $pembelians->hasMorePages() ? 'disabled' : '' }}">&raquo;</a>
</div>
@endif
@endif
@endsection
