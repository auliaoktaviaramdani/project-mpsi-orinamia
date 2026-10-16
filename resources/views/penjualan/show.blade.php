@extends('layouts.simorin')
@section('title', $penjualan->no_jual . ' - Detail Pesanan')

@php
  use App\Support\Fmt;
  $invoiceDP = $penjualan->invoiceDP;
  $invoiceLN = $penjualan->invoicePelunasan;

  $badgeClass = match($penjualan->status) {
    'BELUM_BAYAR' => 'badge-belum',
    'DP_LUNAS'   => 'badge-dp',
    'LUNAS'      => 'badge-lunas',
    'TERKIRIM'   => 'badge-kirim',
    default      => 'badge-belum',
  };
  $badgeLabel = match($penjualan->status) {
    'BELUM_BAYAR' => 'Belum Bayar',
    'DP_LUNAS'   => 'DP Lunas',
    'LUNAS'      => 'Lunas',
    'TERKIRIM'   => 'Terkirim',
    default      => $penjualan->status,
  };
@endphp

@section('content')
<div x-data="{
  showPayModal: false,
  payType: '',
  payInvoiceId: null,
  payMax: 0,
  payRoute: '',
  payTanggal: '{{ now()->toDateString() }}',
  payJumlah: 0,
  openPay(type, invoiceId, max, route) {
    this.payType = type; this.payInvoiceId = invoiceId;
    this.payMax = max; this.payRoute = route;
    this.payJumlah = max; this.showPayModal = true;
    this.$nextTick(() => document.getElementById('pay-jumlah')?.focus());
  }
}">

<div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
  <a href="{{ route('penjualan.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">
    &larr; Daftar Pesanan
  </a>
  <div style="flex:1;">
    <div style="display:flex;align-items:baseline;gap:10px;flex-wrap:wrap;">
      <h1 class="font-num" style="font-size:1.5rem;font-weight:700;">{{ $penjualan->no_jual }}</h1>
      <span class="{{ $badgeClass }}" style="padding:4px 12px;border-radius:6px;font-size:0.75rem;font-weight:700;">{{ $badgeLabel }}</span>
    </div>
    <p style="font-size:0.8125rem;color:var(--muted);margin-top:4px;">
      {{ $penjualan->pelanggan->nama }} ({{ $penjualan->pelanggan->no_pelanggan }})
      &bull; {{ Fmt::tgl($penjualan->tgl_jual) }}
      &bull; Pencatat: {{ $penjualan->user->name }}
    </p>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr;gap:20px;">

  <!-- Detail Item -->
  <div class="panel">
    <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
      <h2 style="font-weight:700;font-size:0.9375rem;">Item Pakaian Dipesan</h2>
      <span style="font-size:0.8rem;color:var(--muted);">{{ $penjualan->details->count() }} item</span>
    </div>
    <div style="overflow-x:auto;">
      <table class="tbl" style="width:100%;border-collapse:collapse;">
        <thead>
          <tr>
            <th>Nama Item</th>
            <th>Ukuran</th>
            <th style="text-align:right;">Qty</th>
            <th style="text-align:right;">Harga Satuan</th>
            <th style="text-align:right;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penjualan->details as $d)
          <tr>
            <td style="font-weight:600;">{{ $d->nama_item }}</td>
            <td style="color:var(--muted);">{{ $d->ukuran ?: '-' }}</td>
            <td class="font-num" style="text-align:right;">{{ number_format($d->qty, 0, ',', '.') }}</td>
            <td class="font-num" style="text-align:right;">{{ Fmt::rp($d->harga_satuan) }}</td>
            <td class="font-num" style="text-align:right;font-weight:600;">{{ Fmt::rp($d->subtotal) }}</td>
          </tr>
          @empty
          <tr><td colspan="5" style="text-align:center;padding:24px;color:var(--muted);">Tidak ada item</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="padding:16px 20px;background:var(--tint);border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
      <span style="font-size:0.8rem;color:var(--muted);">Total Nilai Pesanan</span>
      <span class="font-num" style="font-size:1.25rem;font-weight:700;">{{ Fmt::rp($penjualan->total) }}</span>
    </div>
  </div>

  <!-- Ringkasan -->
  <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
    <div class="panel" style="padding:16px;">
      <div style="font-size:0.75rem;color:var(--muted);font-weight:600;margin-bottom:6px;">Total Pesanan</div>
      <div class="font-num" style="font-size:1.125rem;font-weight:700;">{{ Fmt::rp($penjualan->total) }}</div>
    </div>
    <div class="panel" style="padding:16px;">
      <div style="font-size:0.75rem;color:var(--muted);font-weight:600;margin-bottom:6px;">Sudah Terbayar</div>
      <div class="font-num" style="font-size:1.125rem;font-weight:700;color:#064E3B;">{{ Fmt::rp($penjualan->paid) }}</div>
    </div>
    <div class="panel" style="padding:16px;">
      <div style="font-size:0.75rem;color:var(--muted);font-weight:600;margin-bottom:6px;">Sisa Piutang</div>
      <div class="font-num" style="font-size:1.125rem;font-weight:700;color:{{ $penjualan->balance_due > 0 ? '#7F1D1D' : '#064E3B' }};">
        {{ Fmt::rp($penjualan->balance_due) }}
      </div>
    </div>
  </div>

  <!-- 2 Kartu Invoice -->
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

    <!-- Invoice DP -->
    @if($invoiceDP)
    <div class="panel" style="padding:20px;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
        <div>
          <div style="font-size:0.75rem;color:var(--muted);font-weight:600;">Tagihan Tahap 1 - Uang Muka (DP)</div>
          <div class="font-num" style="font-weight:700;font-size:0.9rem;margin-top:4px;">{{ $invoiceDP->nomor }}</div>
        </div>
        <span class="{{ $invoiceDP->status === 'LUNAS' ? 'badge-lunas' : 'badge-belum' }}"
              style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;white-space:nowrap;">
          {{ $invoiceDP->status === 'LUNAS' ? 'Lunas' : 'Belum Bayar' }}
        </span>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:12px;border-radius:8px;background:var(--tint);border:1px solid var(--border);font-size:0.8rem;margin-bottom:12px;">
        <div>
          <div style="color:var(--muted);">Nominal DP</div>
          <strong class="font-num" style="display:block;margin-top:3px;">{{ Fmt::rp($invoiceDP->jumlah) }}</strong>
        </div>
        <div>
          <div style="color:var(--muted);">Jatuh Tempo</div>
          <strong class="font-num" style="display:block;margin-top:3px;">{{ Fmt::tglPendek($invoiceDP->jatuh_tempo) }}</strong>
        </div>
        @if($invoiceDP->pembayarans->isNotEmpty())
        <div>
          <div style="color:var(--muted);">Sudah Dibayar</div>
          <strong class="font-num" style="display:block;margin-top:3px;color:#064E3B;">{{ Fmt::rp($invoiceDP->totalPaid()) }}</strong>
        </div>
        <div>
          <div style="color:var(--muted);">Sisa</div>
          <strong class="font-num" style="display:block;margin-top:3px;color:#7F1D1D;">{{ Fmt::rp($invoiceDP->sisaTagihan()) }}</strong>
        </div>
        @endif
      </div>

      @if($invoiceDP->pembayarans->isNotEmpty())
      <div style="font-size:0.75rem;color:#064E3B;margin-bottom:10px;">
        Terakhir dibayar: {{ Fmt::tglPendek($invoiceDP->pembayarans->last()->tanggal) }}
        ({{ Fmt::rp($invoiceDP->pembayarans->last()->jumlah) }})
      </div>
      @endif

      <div style="display:flex;gap:8px;flex-wrap:wrap;">
        @if(auth()->user()->role === 'admin' && $invoiceDP->status !== 'LUNAS')
        <button type="button" class="btn-primary" style="font-size:0.75rem;min-height:38px;padding:6px 12px;"
                @click="openPay('DP', {{ $invoiceDP->id }}, {{ $invoiceDP->sisaTagihan() }}, '{{ route('pembayaran.store', $invoiceDP) }}')"
                id="btn-bayar-dp">
          Catat Bayar DP
        </button>
        @endif
        <a href="{{ route('invoice.cetak', $invoiceDP) }}" class="btn-outline" style="font-size:0.75rem;min-height:38px;padding:6px 12px;" target="_blank">
          Cetak Invoice DP
        </a>
      </div>
    </div>
    @else
    <div class="panel" style="padding:20px;text-align:center;">
      <p style="color:var(--muted);font-size:0.875rem;">Invoice DP tidak ditemukan</p>
    </div>
    @endif

    <!-- Invoice Pelunasan -->
    @if($invoiceLN)
    <div class="panel" style="padding:20px;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
        <div>
          <div style="font-size:0.75rem;color:var(--muted);font-weight:600;">Tagihan Tahap 2 - Pelunasan</div>
          <div class="font-num" style="font-weight:700;font-size:0.9rem;margin-top:4px;">{{ $invoiceLN->nomor }}</div>
        </div>
        <span class="{{ $invoiceLN->status === 'LUNAS' ? 'badge-lunas' : 'badge-belum' }}"
              style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;white-space:nowrap;">
          {{ $invoiceLN->status === 'LUNAS' ? 'Lunas' : 'Belum Bayar' }}
        </span>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:12px;border-radius:8px;background:var(--tint);border:1px solid var(--border);font-size:0.8rem;margin-bottom:12px;">
        <div>
          <div style="color:var(--muted);">Nominal Pelunasan</div>
          <strong class="font-num" style="display:block;margin-top:3px;">{{ Fmt::rp($invoiceLN->jumlah) }}</strong>
        </div>
        <div>
          <div style="color:var(--muted);">Jatuh Tempo</div>
          <strong class="font-num" style="display:block;margin-top:3px;">{{ Fmt::tglPendek($invoiceLN->jatuh_tempo) }}</strong>
        </div>
        @if($invoiceLN->pembayarans->isNotEmpty())
        <div>
          <div style="color:var(--muted);">Sudah Dibayar</div>
          <strong class="font-num" style="display:block;margin-top:3px;color:#064E3B;">{{ Fmt::rp($invoiceLN->totalPaid()) }}</strong>
        </div>
        <div>
          <div style="color:var(--muted);">Sisa</div>
          <strong class="font-num" style="display:block;margin-top:3px;color:#7F1D1D;">{{ Fmt::rp($invoiceLN->sisaTagihan()) }}</strong>
        </div>
        @endif
      </div>

      @if($invoiceLN->pembayarans->isNotEmpty())
      <div style="font-size:0.75rem;color:#064E3B;margin-bottom:10px;">
        Terakhir dibayar: {{ Fmt::tglPendek($invoiceLN->pembayarans->last()->tanggal) }}
        ({{ Fmt::rp($invoiceLN->pembayarans->last()->jumlah) }})
      </div>
      @else
      <div style="font-size:0.75rem;color:#7F1D1D;margin-bottom:10px;">Menunggu pembayaran pelunasan</div>
      @endif

      <div style="display:flex;gap:8px;flex-wrap:wrap;">
        @if(auth()->user()->role === 'admin' && $invoiceLN->status !== 'LUNAS')
        <button type="button" class="btn-primary" style="font-size:0.75rem;min-height:38px;padding:6px 12px;"
                @click="openPay('PELUNASAN', {{ $invoiceLN->id }}, {{ $invoiceLN->sisaTagihan() }}, '{{ route('pembayaran.store', $invoiceLN) }}')"
                id="btn-bayar-ln">
          Catat Pelunasan
        </button>
        @endif
        <a href="{{ route('invoice.cetak', $invoiceLN) }}" class="btn-outline" style="font-size:0.75rem;min-height:38px;padding:6px 12px;" target="_blank">
          Cetak Invoice Pelunasan
        </a>
      </div>
    </div>
    @else
    <div class="panel" style="padding:20px;text-align:center;">
      <p style="color:var(--muted);font-size:0.875rem;">Invoice Pelunasan tidak ditemukan</p>
    </div>
    @endif

  </div>

  <!-- Tandai Terkirim -->
  @if(auth()->user()->role === 'admin')
  <div class="panel" style="padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
    <div>
      <div style="font-size:0.875rem;font-weight:700;">Pengiriman Pesanan ke Pelanggan</div>
      <div style="font-size:0.8rem;color:var(--muted);margin-top:2px;">
        @if($penjualan->status === 'LUNAS')
          Semua tagihan telah lunas. Tandai pesanan sebagai terkirim setelah barang dikirim.
        @elseif($penjualan->status === 'TERKIRIM')
          Pesanan ini sudah ditandai sebagai terkirim.
        @else
          Tombol aktif hanya setelah semua invoice lunas (status: Lunas).
        @endif
      </div>
    </div>
    @if($penjualan->status === 'LUNAS')
    <form action="{{ route('penjualan.terkirim', $penjualan) }}" method="POST" style="display:inline;">
      @csrf
      @method('PATCH')
      <button type="submit" class="btn-primary" id="btn-terkirim"
              onclick="return confirm('Tandai pesanan ini sebagai TERKIRIM?')">
        Tandai Terkirim
      </button>
    </form>
    @elseif($penjualan->status === 'TERKIRIM')
    <span class="badge-kirim" style="padding:6px 16px;border-radius:6px;font-size:0.8rem;font-weight:700;">
      Sudah Terkirim
    </span>
    @else
    <button type="button" class="btn-outline" disabled style="opacity:0.5;cursor:not-allowed;">
      Tandai Terkirim
    </button>
    @endif
  </div>
  @endif

</div><!-- end grid -->

<!-- Modal Pembayaran -->
@if(auth()->user()->role === 'admin')
<div x-show="showPayModal" x-transition class="modal-overlay" style="display:none;"
     @keydown.escape.window="showPayModal = false" role="dialog" aria-modal="true" aria-label="Catat Pembayaran">
  <div class="modal-box" @click.stop>
    <h2 style="font-weight:700;font-size:1.125rem;margin-bottom:4px;">
      Catat Pembayaran <span x-text="payType === 'DP' ? 'Invoice DP' : 'Invoice Pelunasan'"></span>
    </h2>
    <p style="font-size:0.8rem;color:var(--muted);margin-bottom:20px;">
      Sisa tagihan:
      <span class="font-num" style="font-weight:700;" x-text="'Rp ' + Math.round(payMax).toLocaleString('id-ID')"></span>
    </p>

    <form :action="payRoute" method="POST">
      @csrf
      <div style="margin-bottom:14px;">
        <label class="form-label" for="pay-tanggal">Tanggal Pembayaran *</label>
        <input type="date" id="pay-tanggal" name="tanggal" class="form-input" required x-model="payTanggal" autofocus>
      </div>
      <div style="margin-bottom:20px;">
        <label class="form-label" for="pay-jumlah">Jumlah Dibayar (Rp) *</label>
        <input type="number" id="pay-jumlah" name="jumlah" class="form-input font-num"
               required min="1" :max="payMax" step="100"
               x-model.number="payJumlah"
               :placeholder="'Maks Rp ' + Math.round(payMax).toLocaleString('id-ID')">
      </div>
      <div style="display:flex;justify-content:flex-end;gap:8px;">
        <button type="button" class="btn-outline" @click="showPayModal = false" id="btn-batal-bayar">Batal</button>
        <button type="submit" class="btn-primary" id="btn-konfirmasi-bayar">Konfirmasi Pembayaran</button>
      </div>
    </form>
  </div>
</div>
@endif

</div><!-- end x-data -->
@endsection
