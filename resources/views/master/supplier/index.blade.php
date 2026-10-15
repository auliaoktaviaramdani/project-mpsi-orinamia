@extends('layouts.simorin')
@section('title', 'Data Master Supplier')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
  <div>
    <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;">Data Master Supplier</h1>
    <p style="font-size:0.8375rem;color:var(--muted);margin-top:4px;">Daftar supplier bahan baku Orinamia.</p>
  </div>
  <a href="{{ route('master.supplier.create') }}" class="btn-primary" id="btn-supplier-baru">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
    Tambah Supplier
  </a>
</div>

@if($suppliers->isEmpty())
<div class="panel" style="padding:64px;text-align:center;">
  <p class="font-editorial" style="font-size:1.375rem;font-weight:600;margin-bottom:8px;">Belum Ada Supplier</p>
  <a href="{{ route('master.supplier.create') }}" class="btn-primary" style="margin-top:12px;">Tambah Supplier</a>
</div>
@else
<div class="panel" style="overflow-x:auto;">
  <table class="tbl" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama Supplier</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Status</th>
        <th style="text-align:center;">Tindakan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suppliers as $s)
      <tr>
        <td class="font-num" style="font-weight:700;font-size:0.8125rem;">{{ $s->no_supplier }}</td>
        <td style="font-weight:600;">{{ $s->nama }}</td>
        <td class="font-num" style="font-size:0.8rem;">{{ $s->tlp ?: '-' }}</td>
        <td style="font-size:0.8rem;color:var(--muted);">{{ $s->alamat ?: '-' }}</td>
        <td>
          <span style="padding:3px 10px;border-radius:6px;font-size:0.7rem;font-weight:700;{{ $s->is_active ? 'background:#D1FAE5;color:#064E3B;' : 'background:#F3F4F6;color:#6B7280;' }}">
            {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td style="text-align:center;white-space:nowrap;">
          <a href="{{ route('master.supplier.edit', $s) }}" class="btn-outline" style="font-size:0.75rem;min-height:34px;padding:4px 10px;" id="btn-ubah-{{ $s->id }}">Ubah</a>
          <form action="{{ route('master.supplier.destroy', $s) }}" method="POST" style="display:inline;"
                onsubmit="return confirm('Hapus supplier {{ addslashes($s->nama) }}?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger" style="font-size:0.75rem;min-height:34px;padding:4px 10px;"
                    id="btn-hapus-{{ $s->id }}"
                    {{ $s->digunakan() ? 'disabled title=Sudah digunakan dalam transaksi' : '' }}>
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
