@extends('layouts.simorin')
@section('title', 'Cetak Invoice - ' . $invoice->nomor)

@php
  use App\Support\Fmt;
  $penjualan = $invoice->penjualan;
  $pelanggan = $penjualan->pelanggan;
  $isDP      = $invoice->jenis === 'DP';
@endphp

@section('content')

<div class="no-print" style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
  <a href="{{ route('penjualan.show', $penjualan) }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">
    &larr; Kembali
  </a>
  <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;flex:1;">
    Cetak {{ $isDP ? 'Invoice DP' : 'Invoice Pelunasan' }}
  </h1>
  <button onclick="window.print()" class="btn-primary" id="btn-cetak">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
    </svg>
    Cetak Dokumen
  </button>
</div>

<!-- Lembar A4 -->
<div id="invoice-print" style="max-width:800px;margin:0 auto;background:#FFFFFF;border:1px solid #E4DFEC;border-radius:8px;padding:48px;color:#2D2B33;">

  <!-- Header Invoice -->
  <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:24px;border-bottom:2px solid #E4DFEC;padding-bottom:28px;margin-bottom:28px;">

    <!-- Logo & Alamat -->
    <div>
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
        <svg width="48" height="48" viewBox="0 0 100 100" fill="none" role="img" aria-label="Logo Orinamia">
          <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
          <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
          <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
          <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
        </svg>
        <div>
          <div style="font-size:1.25rem;font-weight:800;letter-spacing:0.14em;">
            <span style="color:#F391EC;">ORI</span><span style="color:#AD8EEB;">NAMIA</span>
          </div>
          <div style="font-size:0.6rem;letter-spacing:0.3em;color:#635D73;font-weight:700;">DAILY WEAR</div>
        </div>
      </div>
      <p style="font-size:0.8rem;color:#635D73;line-height:1.6;">
        Jalan Tongkol Raya no 20C perum 1 Karawaci Tangerang<br>
        M: 085716107394
      </p>
    </div>

    <!-- Judul & Nomor Invoice -->
    <div style="text-align:right;">
      <span style="display:inline-block;padding:6px 18px;border-radius:6px;background:#6E387A;color:#fff;font-size:0.875rem;font-weight:800;letter-spacing:0.1em;text-transform:uppercase;">
        {{ $isDP ? 'INVOICE DP' : 'INVOICE PELUNASAN' }}
      </span>
      <p style="font-family:'JetBrains Mono',monospace;font-size:1rem;font-weight:700;margin-top:10px;">
        {{ $invoice->nomor }}
      </p>
      <p style="font-size:0.8rem;color:#635D73;margin-top:4px;">
        Tgl. Terbit: <span style="font-family:'JetBrains Mono',monospace;">{{ Fmt::tgl(now()) }}</span>
      </p>
      <p style="font-size:0.8rem;color:#635D73;margin-top:2px;">
        Jatuh Tempo: <span style="font-family:'JetBrains Mono',monospace;font-weight:700;color:{{ now()->gt($invoice->jatuh_tempo) && $invoice->status === 'BELUM_BAYAR' ? '#7F1D1D' : '#2D2B33' }}">
          {{ Fmt::tgl($invoice->jatuh_tempo) }}
        </span>
      </p>
    </div>
  </div>

  <!-- Info Tagihan -->
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:28px;">
    <div>
      <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#635D73;margin-bottom:6px;">Ditagihkan Kepada</div>
      <div style="font-weight:700;font-size:1rem;">{{ $pelanggan->nama }}</div>
      <div style="font-family:'JetBrains Mono',monospace;font-size:0.8rem;color:#635D73;margin-top:2px;">{{ $pelanggan->no_pelanggan }}</div>
      @if($pelanggan->alamat)
      <div style="font-size:0.85rem;color:#635D73;margin-top:4px;">{{ $pelanggan->alamat }}</div>
      @endif
      @if($pelanggan->tlp)
      <div style="font-family:'JetBrains Mono',monospace;font-size:0.8rem;color:#635D73;margin-top:2px;">{{ $pelanggan->tlp }}</div>
      @endif
    </div>
    <div>
      <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#635D73;margin-bottom:6px;">Referensi Pesanan</div>
      <div style="font-family:'JetBrains Mono',monospace;font-weight:700;">{{ $penjualan->no_jual }}</div>
      <div style="font-size:0.85rem;color:#635D73;margin-top:2px;">Tgl. Pesanan: {{ Fmt::tgl($penjualan->tgl_jual) }}</div>
    </div>
  </div>

  <!-- Tabel Item -->
  <table style="width:100%;border-collapse:collapse;margin-bottom:24px;">
    <thead>
      <tr style="background:#FAF9FC;border-bottom:2px solid #E4DFEC;">
        <th style="padding:10px 12px;text-align:left;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#635D73;">Nama Item</th>
        <th style="padding:10px 8px;text-align:center;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#635D73;">Ukuran</th>
        <th style="padding:10px 8px;text-align:right;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#635D73;">Qty</th>
        <th style="padding:10px 12px;text-align:right;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#635D73;">Harga Satuan</th>
        <th style="padding:10px 12px;text-align:right;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#635D73;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($penjualan->details as $d)
      <tr style="border-bottom:1px solid #F0EAF8;">
        <td style="padding:10px 12px;font-size:0.875rem;font-weight:600;">{{ $d->nama_item }}</td>
        <td style="padding:10px 8px;text-align:center;font-size:0.875rem;color:#635D73;">{{ $d->ukuran ?: '-' }}</td>
        <td style="padding:10px 8px;text-align:right;font-family:'JetBrains Mono',monospace;font-size:0.875rem;">{{ $d->qty }}</td>
        <td style="padding:10px 12px;text-align:right;font-family:'JetBrains Mono',monospace;font-size:0.875rem;">{{ Fmt::rp($d->harga_satuan) }}</td>
        <td style="padding:10px 12px;text-align:right;font-family:'JetBrains Mono',monospace;font-size:0.875rem;font-weight:600;">{{ Fmt::rp($d->subtotal) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Ringkasan -->
  <div style="display:flex;justify-content:flex-end;margin-bottom:28px;">
    <div style="min-width:320px;">
      <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #E4DFEC;font-size:0.875rem;">
        <span style="color:#635D73;">Total Nilai Pesanan</span>
        <span style="font-family:'JetBrains Mono',monospace;font-weight:600;">{{ Fmt::rp($penjualan->total) }}</span>
      </div>
      @if($isDP)
      <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #E4DFEC;font-size:0.875rem;">
        <span style="color:#635D73;">Invoice Pelunasan (ditangguhkan)</span>
        <span style="font-family:'JetBrains Mono',monospace;color:#635D73;">{{ Fmt::rp($penjualan->total - $invoice->jumlah) }}</span>
      </div>
      @endif
      <div style="display:flex;justify-content:space-between;padding:12px 0;font-size:1rem;font-weight:700;border-top:2px solid #6E387A;margin-top:4px;">
        <span>{{ $isDP ? 'Tagihan DP' : 'Tagihan Pelunasan' }}</span>
        <span style="font-family:'JetBrains Mono',monospace;color:#6E387A;">{{ Fmt::rp($invoice->jumlah) }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:0.875rem;">
        <span style="color:#635D73;">Sudah Dibayar</span>
        <span style="font-family:'JetBrains Mono',monospace;color:#064E3B;font-weight:600;">{{ Fmt::rp($invoice->totalPaid()) }}</span>
      </div>
      <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:0.9rem;font-weight:700;">
        <span>Sisa (Balance Due)</span>
        <span style="font-family:'JetBrains Mono',monospace;color:{{ $invoice->sisaTagihan() > 0 ? '#7F1D1D' : '#064E3B' }};">
          {{ Fmt::rp($invoice->sisaTagihan()) }}
        </span>
      </div>
    </div>
  </div>

  <!-- Info Pembayaran -->
  <div style="background:#FAF9FC;border:1px solid #E4DFEC;border-radius:8px;padding:16px;margin-bottom:28px;">
    <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#635D73;margin-bottom:8px;">Transfer Pembayaran ke:</div>
    <div style="font-size:0.9rem;font-weight:700;">Bank BSI</div>
    <div style="font-family:'JetBrains Mono',monospace;font-size:1.125rem;font-weight:700;letter-spacing:0.06em;margin-top:4px;">7273909413</div>
    <div style="font-size:0.85rem;color:#635D73;margin-top:2px;">a/n PT Cahaya Binar Berlian</div>
  </div>

  <!-- Tanda Tangan -->
  <div style="display:flex;justify-content:flex-end;margin-top:16px;">
    <div style="text-align:center;min-width:200px;">
      <div style="font-size:0.8rem;color:#635D73;margin-bottom:60px;">
        Tangerang, {{ Fmt::tgl(now()) }}
      </div>
      <div style="border-top:1.5px solid #2D2B33;padding-top:6px;">
        <div style="font-weight:700;font-size:0.875rem;">{{ $penjualan->user->name }}</div>
        <div style="font-size:0.75rem;color:#635D73;">Orinamia Daily Wear</div>
      </div>
    </div>
  </div>

</div>

<style>
  @media print {
    .no-print { display: none !important; }
    body { background: white !important; padding: 0 !important; }
    #invoice-print {
      border: none !important;
      border-radius: 0 !important;
      padding: 20mm !important;
      max-width: 100% !important;
    }
  }
</style>
@endsection
