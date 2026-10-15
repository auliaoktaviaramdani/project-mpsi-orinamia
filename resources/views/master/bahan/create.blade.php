@extends('layouts.simorin')
@section('title', 'Tambah Bahan Baku')
@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('master.bahan.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Tambah Bahan Baku</h1>
      <p style="font-size:0.8rem;color:var(--muted);">No. Otomatis: <span class="font-num" style="font-weight:700;color:var(--accent);">{{ $noBahan }}</span></p>
    </div>
  </div>
  <div class="panel" style="padding:24px;">
    <form action="{{ route('master.bahan.store') }}" method="POST">
      @csrf
      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Bahan *</label>
        <input type="text" name="nama_bahan" class="form-input" value="{{ old('nama_bahan') }}" required autofocus placeholder="cth. Kain Marbella">
        @error('nama_bahan')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="margin-bottom:16px;">
        <label class="form-label">Satuan *</label>
        <input type="text" name="satuan" class="form-input" value="{{ old('satuan') }}" required placeholder="yard / roll / pak / pcs">
        @error('satuan')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="margin-bottom:24px;">
        <label class="form-label">Harga Beli Acuan (Rp) *</label>
        <input type="number" name="harga_beli" class="form-input font-num" value="{{ old('harga_beli', 0) }}" required min="0" step="100">
        @error('harga_beli')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('master.bahan.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-bahan">Simpan Bahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
