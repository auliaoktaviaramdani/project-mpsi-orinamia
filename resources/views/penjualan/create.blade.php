@extends('layouts.simorin')
@section('title', 'Pesanan Baru')

@section('content')
<div style="max-width:900px;margin:0 auto;">

  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('penjualan.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">
      &larr; Kembali
    </a>
    <div>
      <h1 class="font-editorial" style="font-size:1.625rem;font-weight:600;">Catat Pesanan Baru</h1>
      <p style="font-size:0.8125rem;color:var(--muted);">
        No. Pesanan: <span class="font-num" style="font-weight:600;color:var(--accent);">{{ $noJual }}</span>
        &bull; Pencatat: <strong>{{ auth()->user()->name }}</strong>
      </p>
    </div>
  </div>

  <form action="{{ route('penjualan.store') }}" method="POST" id="form-pesanan" x-data="pesananForm()">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

      <!-- Panel Kiri: Info Pesanan -->
      <div style="grid-column:span 2;" class="panel" style="padding:24px;">
        <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          <div>
            <label for="pelanggan_id" class="form-label">Pelanggan <span style="color:#7F1D1D">*</span></label>
            <div style="display:flex;gap:8px;">
              <select name="pelanggan_id" id="pelanggan_id" class="form-input" required style="flex:1;">
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggans as $pl)
                <option value="{{ $pl->id }}" {{ old('pelanggan_id') == $pl->id ? 'selected' : '' }}>
                  {{ $pl->no_pelanggan }} - {{ $pl->nama }}
                </option>
                @endforeach
              </select>
              @if(auth()->user()->role === 'admin')
              <button type="button" class="btn-outline" style="min-height:42px;padding:6px 12px;white-space:nowrap;font-size:0.75rem;"
                      @click="showNewPelanggan = true" id="btn-pelanggan-baru">
                + Baru
              </button>
              @endif
            </div>
            @error('pelanggan_id')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
          </div>

          <div>
            <label for="tgl_jual" class="form-label">Tanggal Pesanan <span style="color:#7F1D1D">*</span></label>
            <input type="date" name="tgl_jual" id="tgl_jual" class="form-input"
                   value="{{ old('tgl_jual', $today) }}" required>
            @error('tgl_jual')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
          </div>
        </div>
      </div>

      <!-- Panel: Item Pakaian -->
      <div style="grid-column:span 2;" class="panel">
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
          <h2 style="font-weight:700;font-size:0.9375rem;">Item Pakaian Dipesan</h2>
          <button type="button" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.75rem;"
                  @click="addItem()" id="btn-tambah-item">
            + Tambah Item
          </button>
        </div>

        <div style="overflow-x:auto;">
          <table class="tbl" style="width:100%;border-collapse:collapse;">
            <thead>
              <tr>
                <th>Nama Item Pakaian</th>
                <th style="width:100px;">Ukuran</th>
                <th style="width:80px;">Qty</th>
                <th style="width:160px;">Harga Satuan (Rp)</th>
                <th style="text-align:right;width:140px;">Subtotal</th>
                <th style="width:50px;"></th>
              </tr>
            </thead>
            <tbody>
              <template x-for="(item, idx) in items" :key="idx">
                <tr>
                  <td>
                    <input type="text" :name="`items[${idx}][nama_item]`" x-model="item.nama_item"
                           class="form-input" style="min-height:36px;" required placeholder="cth. Kemeja Kerja">
                  </td>
                  <td>
                    <input type="text" :name="`items[${idx}][ukuran]`" x-model="item.ukuran"
                           class="form-input" style="min-height:36px;" placeholder="S/M/L/XL">
                  </td>
                  <td>
                    <input type="number" :name="`items[${idx}][qty]`" x-model.number="item.qty"
                           @input="calcItem(idx)" class="form-input font-num" style="min-height:36px;"
                           min="1" required>
                  </td>
                  <td>
                    <input type="number" :name="`items[${idx}][harga_satuan]`" x-model.number="item.harga_satuan"
                           @input="calcItem(idx)" class="form-input font-num" style="min-height:36px;"
                           min="0" step="100" required>
                  </td>
                  <td style="text-align:right;">
                    <span class="font-num" style="font-weight:600;font-size:0.875rem;" x-text="'Rp ' + formatNum(item.subtotal)"></span>
                  </td>
                  <td>
                    <button type="button" @click="removeItem(idx)"
                            style="background:none;border:none;cursor:pointer;color:#7F1D1D;padding:4px;border-radius:4px;"
                            x-show="items.length > 1" title="Hapus baris">
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                      </svg>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>

        <div style="padding:16px 20px;background:var(--tint);border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
          <span style="font-size:0.8375rem;color:var(--muted);">Total Nilai Pesanan:</span>
          <span class="font-num" style="font-size:1.25rem;font-weight:700;" x-text="'Rp ' + formatNum(grandTotal)"></span>
        </div>
      </div>

      <!-- Panel: Konfigurasi Invoice -->
      <div style="grid-column:span 2;" class="panel">
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);">
          <h2 style="font-weight:700;font-size:0.9375rem;">Konfigurasi Invoice (Terbit Otomatis)</h2>
          <p style="font-size:0.8rem;color:var(--muted);margin-top:4px;">Atur persentase DP dan jatuh tempo. Sistem akan menerbitkan 2 invoice secara otomatis.</p>
        </div>

        <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:20px;">

          <!-- Invoice DP -->
          <div style="padding:16px;border:1px solid var(--border);border-radius:8px;">
            <div style="font-size:0.75rem;font-weight:700;color:var(--accent);margin-bottom:12px;text-transform:uppercase;letter-spacing:0.05em;">
              Invoice DP (Uang Muka)
            </div>
            <div style="margin-bottom:12px;">
              <label class="form-label">Persentase DP (1-100%)</label>
              <div style="display:flex;align-items:center;gap:8px;">
                <input type="number" name="dp_persen" id="dp_persen" class="form-input font-num"
                       x-model.number="dpPersen" @input="calcDP()"
                       min="1" max="100" step="1" value="{{ old('dp_persen', 50) }}" required>
                <span style="font-weight:700;color:var(--muted);">%</span>
              </div>
            </div>
            <div style="margin-bottom:12px;">
              <label class="form-label">Jatuh Tempo</label>
              <input type="date" name="dp_jatuh_tempo" id="dp_jatuh_tempo" class="form-input"
                     value="{{ old('dp_jatuh_tempo', now()->addDays(14)->toDateString()) }}" required>
            </div>
            <div style="font-size:0.8rem;color:var(--muted);">
              Nominal DP:
              <span class="font-num" style="font-weight:700;color:var(--text);" x-text="'Rp ' + formatNum(dpJumlah)"></span>
            </div>
          </div>

          <!-- Invoice Pelunasan -->
          <div style="padding:16px;border:1px solid var(--border);border-radius:8px;">
            <div style="font-size:0.75rem;font-weight:700;color:var(--muted);margin-bottom:12px;text-transform:uppercase;letter-spacing:0.05em;">
              Invoice Pelunasan (Sisa)
            </div>
            <div style="margin-bottom:12px;">
              <div class="form-label">Sisa Pelunasan</div>
              <div class="font-num" style="font-size:1.125rem;font-weight:700;min-height:42px;display:flex;align-items:center;">
                <span x-text="'Rp ' + formatNum(lnJumlah)"></span>
              </div>
            </div>
            <div style="margin-bottom:12px;">
              <label class="form-label">Jatuh Tempo</label>
              <input type="date" name="ln_jatuh_tempo" id="ln_jatuh_tempo" class="form-input"
                     value="{{ old('ln_jatuh_tempo', now()->addDays(28)->toDateString()) }}" required>
            </div>
            <div style="font-size:0.8rem;color:var(--muted);">
              Dihitung otomatis dari total dikurangi nominal DP.
            </div>
          </div>
        </div>
      </div>

      <!-- Submit -->
      <div style="grid-column:span 2;display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('penjualan.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-pesanan">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
          Simpan Pesanan &amp; Terbitkan Invoice
        </button>
      </div>

    </div>
  </form>

  <!-- Modal: Pelanggan Baru -->
  @if(auth()->user()->role === 'admin')
  <div x-show="showNewPelanggan" x-transition class="modal-overlay" style="display:none;"
       @keydown.escape.window="showNewPelanggan = false" x-cloak role="dialog" aria-modal="true" aria-label="Form Pelanggan Baru">
    <div class="modal-box" @click.stop>
      <h2 style="font-weight:700;font-size:1.125rem;margin-bottom:16px;">+ Pelanggan Baru</h2>
      <form id="form-quick-pelanggan" @submit.prevent="submitQuickPelanggan()">
        @csrf
        <div style="margin-bottom:12px;">
          <label class="form-label">Nama Instansi / Pelanggan *</label>
          <input type="text" id="qp-nama" class="form-input" required placeholder="cth. PT Maju Bersama" autofocus>
        </div>
        <div style="margin-bottom:12px;">
          <label class="form-label">No. Telepon</label>
          <input type="text" id="qp-tlp" class="form-input font-num" placeholder="021-xxxxxxx">
        </div>
        <div style="margin-bottom:20px;">
          <label class="form-label">Alamat</label>
          <textarea id="qp-alamat" class="form-input" rows="2" placeholder="Kota atau alamat lengkap"></textarea>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px;">
          <button type="button" class="btn-outline" @click="showNewPelanggan = false">Batal</button>
          <button type="submit" class="btn-primary" id="btn-simpan-pelanggan-baru">Simpan Pelanggan</button>
        </div>
      </form>
    </div>
  </div>
  @endif

</div>
@endsection

@push('scripts')
<script>
function pesananForm() {
  return {
    showNewPelanggan: false,
    dpPersen: {{ old('dp_persen', 50) }},
    items: [{ nama_item: '', ukuran: '', qty: 1, harga_satuan: 0, subtotal: 0 }],

    get grandTotal() {
      return this.items.reduce((s, i) => s + (i.subtotal || 0), 0);
    },
    get dpJumlah() {
      return Math.round(this.grandTotal * (this.dpPersen / 100));
    },
    get lnJumlah() {
      return this.grandTotal - this.dpJumlah;
    },

    calcItem(idx) {
      const item = this.items[idx];
      item.subtotal = (item.qty || 0) * (item.harga_satuan || 0);
    },
    calcDP() {
      // reactive via getters
    },
    addItem() {
      this.items.push({ nama_item: '', ukuran: '', qty: 1, harga_satuan: 0, subtotal: 0 });
    },
    removeItem(idx) {
      if (this.items.length > 1) this.items.splice(idx, 1);
    },
    formatNum(n) {
      return Math.round(n || 0).toLocaleString('id-ID');
    },

    async submitQuickPelanggan() {
      const data = {
        nama:   document.getElementById('qp-nama').value,
        tlp:    document.getElementById('qp-tlp').value,
        alamat: document.getElementById('qp-alamat').value,
        _token: document.querySelector('meta[name="csrf-token"]').content,
      };
      const res = await fetch('{{ route('master.pelanggan.quick') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': data._token },
        body: JSON.stringify(data),
      });
      const json = await res.json();
      if (json.success) {
        const sel = document.getElementById('pelanggan_id');
        const opt = document.createElement('option');
        opt.value   = json.pelanggan.id;
        opt.text    = json.pelanggan.no_pelanggan + ' - ' + json.pelanggan.nama;
        opt.selected = true;
        sel.appendChild(opt);
        this.showNewPelanggan = false;
        document.getElementById('qp-nama').value   = '';
        document.getElementById('qp-tlp').value    = '';
        document.getElementById('qp-alamat').value = '';
      }
    },
  };
}
</script>
@endpush
