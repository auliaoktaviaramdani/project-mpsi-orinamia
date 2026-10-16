@extends('layouts.simorin')
@section('title', 'Tambah Akun Pengguna')

@section('content')
<div style="max-width:560px;margin:0 auto;">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('akun.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">&larr;</a>
    <div>
      <h1 class="font-editorial" style="font-size:1.5rem;font-weight:600;">Tambah Akun Pengguna</h1>
      <p style="font-size:0.8rem;color:var(--muted);">Daftarkan akun baru untuk staf admin atau pemilik Orinamia</p>
    </div>
  </div>

  <div class="panel" style="padding:24px;">
    <form action="{{ route('akun.store') }}" method="POST">
      @csrf

      <div style="margin-bottom:16px;">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}" required placeholder="Contoh: Siti Rahmawati" autofocus>
        @error('name')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;">
        <label class="form-label">Username Akun *</label>
        <input type="text" name="username" class="form-input font-num" value="{{ old('username') }}" required placeholder="Contoh: sitirahma">
        @error('username')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;">
        <label class="form-label">Peran Akses (Role) *</label>
        <select name="role" class="form-input" required>
          <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin Operasional (Input pesanan, cetak invoice, kelola master)</option>
          <option value="owner" {{ old('role') === 'owner' ? 'selected' : '' }}>Owner / Pimpinan (Melihat seluruh data transaksi dan laporan)</option>
        </select>
        @error('role')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:16px;">
        <label class="form-label">Kata Sandi (Password) *</label>
        <input type="password" name="password" class="form-input" required placeholder="Minimal 6 karakter">
        @error('password')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
      </div>

      <div style="margin-bottom:24px;">
        <label class="form-label">Konfirmasi Kata Sandi *</label>
        <input type="password" name="password_confirmation" class="form-input" required placeholder="Ketik ulang kata sandi">
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('akun.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-akun">Simpan Akun</button>
      </div>
    </form>
  </div>
</div>
@endsection
