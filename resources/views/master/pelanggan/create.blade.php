@extends('layouts.simorin')
@section('title', 'Tambah Pelanggan')
@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('master.pelanggan.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Tambah Pelanggan</h1>
      <p style="font-size:0.8rem;color:var(--muted);">No. Otomatis: <span class="font-num" style="font-weight:700;color:var(--accent);">{{ $noPelanggan }}</span></p>
    </div>
  </div>

  <div class="panel" style="padding:24px;">
    <form action="{{ route('master.pelanggan.store') }}" method="POST">
      @csrf
      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Instansi / Pelanggan *</label>
        <input type="text" name="nama" class="form-input" value="{{ old('nama') }}" required placeholder="PT / CV / Instansi / Perorangan" autofocus>
        @error('nama')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="margin-bottom:16px;">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="tlp" class="form-input font-num" value="{{ old('tlp') }}" placeholder="021-xxxxxxx">
      </div>
      <div style="margin-bottom:24px;">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-input" rows="3" placeholder="Kota atau alamat lengkap">{{ old('alamat') }}</textarea>
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('master.pelanggan.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-pelanggan">Simpan Pelanggan</button>
      </div>
    </form>
  </div>
</div>
@endsection
