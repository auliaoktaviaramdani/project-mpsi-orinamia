@php use App\Support\Fmt; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Bukti Pembelian - {{ $pembelian->no_beli }}</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; color:#2D2B33; background:#fff; padding:24px; }
    .font-num { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }
    table { width:100%; border-collapse: collapse; }
    th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #E4DFEC; }
    th { background:#FAF9FC; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#635D73; }
    .no-print { display: block; }
    @media print {
      .no-print { display: none !important; }
      body { padding: 10mm; }
    }
  </style>
</head>
<body>

<div class="no-print" style="margin-bottom:20px;">
  <button onclick="window.print()" style="padding:8px 20px;background:#6E387A;color:#fff;border:none;border-radius:6px;cursor:pointer;font-weight:700;">
    Cetak Dokumen
  </button>
  <a href="{{ route('pembelian.show', $pembelian) }}" style="margin-left:10px;color:#6E387A;">Kembali</a>
</div>

<div style="max-width:700px;margin:0 auto;">
  <!-- Header -->
  <div style="display:flex;justify-content:space-between;align-items:flex-start;border-bottom:2px solid #E4DFEC;padding-bottom:20px;margin-bottom:20px;">
    <div>
      <div style="font-size:1.25rem;font-weight:800;letter-spacing:0.14em;">
        <span style="color:#F391EC;">ORI</span><span style="color:#AD8EEB;">NAMIA</span>
      </div>
      <div style="font-size:0.65rem;letter-spacing:0.3em;color:#635D73;font-weight:700;">DAILY WEAR</div>
      <p style="font-size:0.8rem;color:#635D73;margin-top:8px;line-height:1.5;">
        Jalan Tongkol Raya no 20C perum 1 Karawaci Tangerang<br>
        M: 085716107394
      </p>
    </div>
    <div style="text-align:right;">
      <div style="font-weight:800;font-size:1rem;text-transform:uppercase;letter-spacing:0.08em;">BUKTI PEMBELIAN</div>
      <div class="font-num" style="font-weight:700;font-size:0.9rem;margin-top:6px;">{{ $pembelian->no_beli }}</div>
      <div style="font-size:0.8rem;color:#635D73;margin-top:2px;">Tgl. Beli: {{ Fmt::tgl($pembelian->tgl_beli) }}</div>
      @if($pembelian->no_faktur)
      <div class="font-num" style="font-size:0.8rem;color:#635D73;">Faktur: {{ $pembelian->no_faktur }}</div>
      @endif
    </div>
  </div>

  <!-- Supplier -->
  <div style="margin-bottom:20px;">
    <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;color:#635D73;margin-bottom:4px;">Supplier</div>
    <div style="font-weight:700;">{{ $pembelian->supplier->nama }}</div>
    @if($pembelian->supplier->alamat)<div style="font-size:0.85rem;color:#635D73;">{{ $pembelian->supplier->alamat }}</div>@endif
    @if($pembelian->supplier->tlp)<div class="font-num" style="font-size:0.8rem;color:#635D73;">{{ $pembelian->supplier->tlp }}</div>@endif
  </div>

  <!-- Items -->
  <table style="margin-bottom:20px;">
    <thead>
      <tr>
        <th>Bahan Baku</th>
        <th style="text-align:right;">Qty</th>
        <th style="text-align:right;">Harga / Satuan</th>
        <th style="text-align:right;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pembelian->details as $d)
      <tr>
        <td>{{ $d->bahan->nama_bahan }} ({{ $d->bahan->satuan }})</td>
        <td class="font-num" style="text-align:right;">{{ number_format($d->qty, 2, ',', '.') }}</td>
        <td class="font-num" style="text-align:right;">{{ Fmt::rp($d->harga_satuan_saat_transaksi) }}</td>
        <td class="font-num" style="text-align:right;font-weight:700;">{{ Fmt::rp($d->subtotal) }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr style="border-top:2px solid #6E387A;">
        <td colspan="3" style="font-weight:700;text-align:right;">TOTAL PEMBELIAN</td>
        <td class="font-num" style="font-weight:800;text-align:right;color:#6E387A;">{{ Fmt::rp($pembelian->total_beli) }}</td>
      </tr>
    </tfoot>
  </table>

  <!-- Footer -->
  <div style="display:flex;justify-content:flex-end;margin-top:32px;">
    <div style="text-align:center;min-width:180px;">
      <div style="font-size:0.8rem;color:#635D73;margin-bottom:50px;">Tangerang, {{ Fmt::tgl(now()) }}</div>
      <div style="border-top:1.5px solid #2D2B33;padding-top:6px;">
        <div style="font-weight:700;">{{ $pembelian->user->name }}</div>
        <div style="font-size:0.75rem;color:#635D73;">Orinamia Daily Wear</div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
