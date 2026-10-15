@extends('layouts.simorin')
@section('title', 'Ubah Akun Pengguna')

@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('akun.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Ubah Akun Pengguna</h1>
      <p style="font-size:0.8rem;color:var(--muted);">Memperbarui informasi pengguna: <span style="font-weight:600;color:var(--text);">{{ $akun->name }}</span></p>
    </div>
  </div>

  <div class="panel" style="padding:24px;">
    <form action="{{ route('akun.update', $akun) }}" method="POST">
      @csrf
      @method('PUT')

      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="name" class="form-input" value="{{ old('name', $akun->name) }}" required autofocus>
        @error('name')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;">
        <label class="form-label">Username Akun *</label>
        <input type="text" name="username" class="form-input font-num" value="{{ old('username', $akun->username) }}" required>
        @error('username')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;">
        <label class="form-label">Peran Akses (Role) *</label>
        <select name="role" class="form-input" required>
          <option value="admin" {{ old('role', $akun->role) === 'admin' ? 'selected' : '' }}>Admin Operasional</option>
          <option value="owner" {{ old('role', $akun->role) === 'owner' ? 'selected' : '' }}>Owner / Pimpinan</option>
        </select>
        @error('role')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;padding-top:12px;border-top:1px dashed var(--border);">
        <label class="form-label">Kata Sandi Baru (Opsional)</label>
        <input type="password" name="password" class="form-input" placeholder="Kosongkan jika tidak ingin mengubah password">
        <span style="font-size:0.75rem;color:var(--muted);">Biarkan kosong jika kata sandi saat ini tetap dipertahankan.</span>
        @error('password')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:24px;">
        <label class="form-label">Konfirmasi Kata Sandi Baru</label>
        <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru">
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('akun.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-update-akun">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
