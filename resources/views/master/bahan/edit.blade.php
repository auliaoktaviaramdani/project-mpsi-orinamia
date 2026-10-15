@extends('layouts.simorin')
@section('title', 'Ubah Bahan Baku')
@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('master.bahan.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Ubah Bahan Baku</h1>
      <p style="font-size:0.8rem;color:var(--muted);"><span class="font-num" style="font-weight:700;color:var(--accent);">{{ $bahanBaku->no_bahan }}</span></p>
    </div>
  </div>
  <div class="panel" style="padding:24px;">
    <form action="{{ route('master.bahan.update', $bahanBaku) }}" method="POST">
      @csrf @method('PUT')
      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Bahan *</label>
        <input type="text" name="nama_bahan" class="form-input" value="{{ old('nama_bahan', $bahanBaku->nama_bahan) }}" required autofocus>
        @error('nama_bahan')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div style="margin-bottom:16px;">
        <label class="form-label">Satuan *</label>
        <input type="text" name="satuan" class="form-input" value="{{ old('satuan', $bahanBaku->satuan) }}" required>
      </div>
      <div style="margin-bottom:16px;">
        <label class="form-label">Harga Beli Acuan (Rp) *</label>
        <input type="number" name="harga_beli" class="form-input font-num" value="{{ old('harga_beli', $bahanBaku->harga_beli) }}" required min="0" step="100">
      </div>
      <div style="margin-bottom:24px;display:flex;align-items:center;gap:8px;">
        <input type="checkbox" name="is_active" id="is_active" value="1" style="accent-color:#6E387A;width:16px;height:16px;"
               {{ old('is_active', $bahanBaku->is_active) ? 'checked' : '' }}>
        <label for="is_active" style="font-size:0.875rem;cursor:pointer;">Bahan Aktif</label>
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('master.bahan.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-update-bahan">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
