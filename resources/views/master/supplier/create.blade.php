@extends('layouts.simorin')
@section('title', 'Tambah Supplier')
@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('master.supplier.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Tambah Supplier</h1>
      <p style="font-size:0.8rem;color:var(--muted);">No. Otomatis: <span class="font-num" style="font-weight:700;color:var(--accent);">{{ $noSupplier }}</span></p>
    </div>
  </div>
  <div class="panel" style="padding:24px;">
    <form action="{{ route('master.supplier.store') }}" method="POST">
      @csrf
      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Supplier *</label>
        <input type="text" name="nama" class="form-input" value="{{ old('nama') }}" required autofocus>
        @error('nama')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="margin-bottom:16px;">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-input" value="{{ old('alamat') }}" placeholder="Pasar Tanah Abang, dst.">
      </div>
      <div style="margin-bottom:24px;">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="tlp" class="form-input font-num" value="{{ old('tlp') }}" placeholder="021-xxxxxxx">
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('master.supplier.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-supplier">Simpan Supplier</button>
      </div>
    </form>
  </div>
</div>
@endsection
