@extends('layouts.simorin')
@section('title', 'Katalog Bahan Baku')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;">Katalog Bahan <span class="shiny-text">Baku</span></h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">Katalog bahan tanpa stok. Harga adalah harga acuan, disimpan snapshot saat pembelian.</p>
  </div>
  <a href="{{ route('master.bahan.create') }}" class="btn-primary" id="btn-bahan-baru">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
    Tambah Bahan
  </a>
</div>

@if($bahans->isEmpty())
<div class="panel spotlight-card" style="padding:64px;text-align:center;">
  <p class="font-editorial" style="font-size:1.375rem;font-weight:600;margin-bottom:8px;">Belum Ada Bahan Baku</p>
  <a href="{{ route('master.bahan.create') }}" class="btn-primary" style="margin-top:12px;">Tambah Bahan</a>
</div>
@else
<div class="panel spotlight-card" style="overflow-x:auto;">
  <table class="tbl" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama Bahan</th>
        <th>Satuan</th>
        <th style="text-align:right;">Harga Acuan</th>
        <th>Status</th>
        <th style="text-align:center;">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bahans as $b)
      <tr>
        <td class="font-num" style="font-weight:700;font-size:0.8125rem;">{{ $b->no_bahan }}</td>
        <td style="font-weight:600;">{{ $b->nama_bahan }}</td>
        <td style="color:var(--muted);">{{ $b->satuan }}</td>
        <td class="font-num" style="text-align:right;">{{ \App\Support\Fmt::rp($b->harga_beli) }}</td>
        <td>
          <span style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;{{ $b->is_active ? 'background:#D1FAE5;color:#064E3B;' : 'background:#F3F4F6;color:#6B7280;' }}">
            {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td style="text-align:center;white-space:nowrap;">
          <a href="{{ route('master.bahan.edit', $b) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 10px;" id="btn-ubah-{{ $b->id }}">Ubah</a>
          <form action="{{ route('master.bahan.destroy', $b) }}" method="POST" style="display:inline;"
                onsubmit="return confirm('Hapus {{ addslashes($b->nama_bahan) }}?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger" style="font-size:0.75rem;min-height:34px;padding:4px 10px;"
                    id="btn-hapus-{{ $b->id }}"
                    {{ $b->digunakan() ? 'disabled title=Sudah digunakan dalam transaksi' : '' }}>
              Hapus
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection
