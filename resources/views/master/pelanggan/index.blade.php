@extends('layouts.simorin')
@section('title', 'Data Master Pelanggan')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;">Data Master Pelanggan</h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">Daftar pelanggan Orinamia. Tombol hapus dikunci jika sudah dipakai dalam transaksi.</p>
  </div>
  <a href="{{ route('master.pelanggan.create') }}" class="btn-primary" id="btn-pelanggan-baru">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Pelanggan
  </a>
</div>

@if($pelanggans->isEmpty())
<div class="panel" style="padding:64px;text-align:center;">
  <p class="font-editorial" style="font-size:1.375rem;font-weight:600;margin-bottom:8px;">Belum Ada Pelanggan</p>
  <a href="{{ route('master.pelanggan.create') }}" class="btn-primary" style="margin-top:12px;">Tambah Pelanggan</a>
</div>
@else
<div class="panel" style="overflow-x:auto;">
  <table class="tbl" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama Instansi / Pelanggan</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Status</th>
        <th style="text-align:center;">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pelanggans as $p)
      <tr>
        <td class="font-num" style="font-weight:700;font-size:0.8125rem;">{{ $p->no_pelanggan }}</td>
        <td style="font-weight:600;">{{ $p->nama }}</td>
        <td class="font-num" style="font-size:0.8rem;">{{ $p->tlp ?: '-' }}</td>
        <td style="font-size:0.8rem;color:var(--muted);max-width:200px;">{{ $p->alamat ?: '-' }}</td>
        <td>
          <span style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;{{ $p->is_active ? 'background:#D1FAE5;color:#064E3B;' : 'background:#F3F4F6;color:#6B7280;' }}">
            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td style="text-align:center;white-space:nowrap;">
          <a href="{{ route('master.pelanggan.edit', $p) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 10px;" id="btn-ubah-{{ $p->id }}">
            Ubah
          </a>
          <form action="{{ route('master.pelanggan.destroy', $p) }}" method="POST" style="display:inline;"
                onsubmit="return confirm('Hapus pelanggan {{ addslashes($p->nama) }}?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger" style="font-size:0.75rem;min-height:34px;padding:4px 10px;"
                    id="btn-hapus-{{ $p->id }}"
                    {{ $p->digunakan() ? 'disabled title=Sudah digunakan dalam transaksi' : '' }}>
              Hapus
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@if($pelanggans->hasPages())
<div style="display:flex;align-items:center;justify-content:center;gap:6px;flex-wrap:wrap;margin-top:16px;">
  <a href="{{ $pelanggans->previousPageUrl() }}" class="page-link {{ $pelanggans->onFirstPage() ? 'disabled' : '' }}">&laquo;</a>
  @foreach($pelanggans->getUrlRange(1, $pelanggans->lastPage()) as $page => $url)
  <a href="{{ $url }}" class="page-link {{ $pelanggans->currentPage() === $page ? 'active' : '' }}">{{ $page }}</a>
  @endforeach
  <a href="{{ $pelanggans->nextPageUrl() }}" class="page-link {{ ! $pelanggans->hasMorePages() ? 'disabled' : '' }}">&raquo;</a>
</div>
@endif
@endif
@endsection
