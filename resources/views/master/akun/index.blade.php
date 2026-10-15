@extends('layouts.simorin')
@section('title', 'Manajemen Akun Pengguna')

@php use App\Support\Fmt; @endphp

@section('content')
<div style="max-width:1000px;margin:0 auto;display:flex;flex-direction:column;gap:24px;">

  <!-- Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;">
    <div>
      <h1 class="font-editorial" style="font-size:1.75rem;font-weight:600;color:var(--text);letter-spacing:-0.01em;">
        Manajemen Akun Pengguna
      </h1>
      <p style="font-size:0.875rem;color:var(--muted);margin-top:4px;">
        Kelola hak akses untuk Admin Operasional dan Pemilik (Owner) Orinamia Daily Wear.
      </p>
    </div>
    <div>
      <a href="{{ route('akun.create') }}" class="btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Akun Baru
      </a>
    </div>
  </div>

  <!-- User Table Panel -->
  <div class="panel">
    <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
      <h2 style="font-size:0.9375rem;font-weight:700;color:var(--text);">
        Daftar Pengguna Sistem
      </h2>
      <span style="font-size:0.75rem;color:var(--muted);">
        Total: <strong class="font-num" style="color:var(--text);">{{ $akuns->count() }}</strong> akun terdaftar
      </span>
    </div>

    @if($akuns->isEmpty())
      <div style="padding:56px 24px;text-align:center;">
        <p style="font-size:0.9375rem;font-weight:600;color:var(--text);margin-bottom:4px;">
          Belum ada data akun pengguna
        </p>
        <p style="font-size:0.8125rem;color:var(--muted);margin-bottom:16px;">
          Tambahkan akun pengguna baru untuk memberikan akses ke sistem SIMORIN.
        </p>
        <a href="{{ route('akun.create') }}" class="btn-primary">
          Tambah Akun
        </a>
      </div>
    @else
      <div style="overflow-x:auto;">
        <table class="tbl" style="width:100%;border-collapse:collapse;text-align:left;">
          <thead>
            <tr>
              <th style="width:30%;">Nama Lengkap</th>
              <th style="width:25%;">Username</th>
              <th style="width:20%;text-align:center;">Peran (Role)</th>
              <th style="width:25%;text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($akuns as $u)
              <tr>
                <td>
                  <div style="font-weight:600;color:var(--text);">{{ $u->name }}</div>
                  @if($u->id === auth()->id())
                    <span style="display:inline-block;font-size:0.6875rem;font-weight:600;color:var(--accent);background:var(--tint);padding:1px 6px;border-radius:4px;margin-top:2px;">
                      Akun Anda Saat Ini
                    </span>
                  @endif
                </td>
                <td>
                  <span class="font-num" style="font-size:0.875rem;color:var(--muted);">
                    {{ $u->username }}
                  </span>
                </td>
                <td style="text-align:center;">
                  @if($u->role === 'admin')
                    <span style="display:inline-block;padding:3px 10px;border-radius:12px;font-size:0.75rem;font-weight:600;background:var(--tint);color:var(--accent);border:1px solid var(--border);">
                      Admin Operasional
                    </span>
                  @else
                    <span style="display:inline-block;padding:3px 10px;border-radius:12px;font-size:0.75rem;font-weight:600;background:#E0E7FF;color:#3730A3;border:1px solid #C7D2FE;">
                      Owner / Pimpinan
                    </span>
                  @endif
                </td>
                <td style="text-align:center;">
                  <div style="display:inline-flex;align-items:center;gap:8px;">
                    <a href="{{ route('akun.edit', $u) }}" class="btn-outline" style="min-height:32px;padding:4px 10px;font-size:0.75rem;">
                      Ubah
                    </a>
                    
                    @if($u->id !== auth()->id())
                      <form action="{{ route('akun.destroy', $u) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $u->name }}? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" style="min-height:32px;padding:4px 10px;font-size:0.75rem;">
                          Hapus
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

</div>
@endsection
