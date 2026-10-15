@extends('layouts.simorin')
@section('title', 'Catat Pembelian Bahan')

@section('content')
<div style="max-width:900px;margin:0 auto;" x-data="pembelianForm()">

  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('pembelian.index') }}" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.8rem;">
      &larr; Kembali
    </a>
    <div>
      <h1 class="font-editorial" style="font-size:1.625rem;font-weight:600;">Catat Pembelian <span class="shiny-text">Bahan</span></h1>
      <p style="font-size:0.8125rem;color:var(--muted);">
        No. Beli: <span class="font-num" style="font-weight:600;color:var(--accent);">{{ $noBeli }}</span>
      </p>
    </div>
  </div>

  <form action="{{ route('pembelian.store') }}" method="POST">
    @csrf

    <div style="display:grid;gap:20px;">

      <!-- Info Pembelian -->
      <div class="panel spotlight-card" style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div>
          <label for="supplier_id" class="form-label">Supplier <span style="color:#7F1D1D">*</span></label>
          <div style="display:flex;gap:8px;">
            <select name="supplier_id" id="supplier_id" class="form-input" required style="flex:1;">
              <option value="">-- Pilih Supplier --</option>
              @foreach($suppliers as $s)
              <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                {{ $s->no_supplier }} - {{ $s->nama }}
              </option>
              @endforeach
            </select>
            <button type="button" class="btn-outline" style="min-height:42px;padding:6px 12px;white-space:nowrap;font-size:0.75rem;"
                    @click="showNewSupplier = true" id="btn-supplier-baru">
              + Baru
            </button>
          </div>
          @error('supplier_id')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="tgl_beli" class="form-label">Tanggal Beli <span style="color:#7F1D1D">*</span></label>
          <input type="date" name="tgl_beli" id="tgl_beli" class="form-input"
                 value="{{ old('tgl_beli', $today) }}" required>
          @error('tgl_beli')<p style="color:#7F1D1D;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="no_faktur" class="form-label">No. Faktur Supplier</label>
          <input type="text" name="no_faktur" id="no_faktur" class="form-input font-num"
                 value="{{ old('no_faktur') }}" placeholder="FK-XXXX (opsional)">
        </div>
      </div>

      <!-- Item Bahan -->
      <div class="panel">
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
          <h2 style="font-weight:700;font-size:0.9375rem;">Item Bahan Baku</h2>
          <button type="button" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.75rem;"
                  @click="addItem()" id="btn-tambah-bahan">
            + Tambah Bahan
          </button>
        </div>

        <div style="overflow-x:auto;">
          <table class="tbl" style="width:100%;border-collapse:collapse;">
            <thead>
              <tr>
                <th>Bahan Baku</th>
                <th style="width:120px;">Qty</th>
                <th style="width:180px;">Harga Saat Ini (Rp)</th>
                <th style="text-align:right;width:160px;">Subtotal</th>
                <th style="width:50px;"></th>
              </tr>
            </thead>
            <tbody>
              <template x-for="(item, idx) in items" :key="idx">
                <tr>
                  <td>
                    <select :name="`items[${idx}][bahan_id]`" x-model="item.bahan_id"
                            @change="setDefaultHarga(idx)" class="form-input" required style="min-height:36px;">
                      <option value="">-- Pilih Bahan --</option>
                      @foreach($bahans as $b)
                      <option value="{{ $b->id }}" data-harga="{{ $b->harga_beli }}">
                        {{ $b->no_bahan }} - {{ $b->nama_bahan }} ({{ $b->satuan }})
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" :name="`items[${idx}][qty]`" x-model.number="item.qty"
                           @input="calcItem(idx)" class="form-input font-num"
                           min="0.01" step="0.01" required style="min-height:36px;">
                  </td>
                  <td>
                    <input type="number" :name="`items[${idx}][harga_satuan_saat_transaksi]`"
                           x-model.number="item.harga" @input="calcItem(idx)"
                           class="form-input font-num" min="0" step="100" required style="min-height:36px;">
                  </td>
                  <td style="text-align:right;">
                    <span class="font-num" style="font-weight:600;" x-text="'Rp ' + formatNum(item.subtotal)"></span>
                  </td>
                  <td>
                    <button type="button" @click="removeItem(idx)"
                            style="background:none;border:none;cursor:pointer;color:#7F1D1D;padding:4px;border-radius:4px;"
                            x-show="items.length > 1">
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
          <span style="font-size:0.8375rem;color:var(--muted);">Total Pembelian:</span>
          <span class="font-num" style="font-size:1.25rem;font-weight:700;" x-text="'Rp ' + formatNum(grandTotal)"></span>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('pembelian.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-pembelian">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
          Simpan Pembelian
        </button>
      </div>
    </div>
  </form>

  <!-- Modal Supplier Baru -->
  <div x-show="showNewSupplier" x-transition class="modal-overlay" style="display:none;"
       @keydown.escape.window="showNewSupplier = false" role="dialog" aria-modal="true" aria-label="Form Supplier Baru">
    <div class="modal-box" @click.stop>
      <h2 style="font-weight:700;font-size:1.125rem;margin-bottom:16px;">Tambah Supplier Baru</h2>
      <form @submit.prevent="submitQuickSupplier()">
        @csrf
        <div style="margin-bottom:12px;">
          <label class="form-label">Nama Supplier *</label>
          <input type="text" id="qs-nama" class="form-input" required placeholder="Nama toko/supplier" autofocus>
        </div>
        <div style="margin-bottom:12px;">
          <label class="form-label">Alamat</label>
          <input type="text" id="qs-alamat" class="form-input" placeholder="Pasar Tanah Abang, dst.">
        </div>
        <div style="margin-bottom:20px;">
          <label class="form-label">No. Telepon</label>
          <input type="text" id="qs-tlp" class="form-input font-num" placeholder="021-xxxxxxx">
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px;">
          <button type="button" class="btn-outline" @click="showNewSupplier = false">Batal</button>
          <button type="submit" class="btn-primary" id="btn-simpan-supplier-baru">Simpan Supplier</button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
const bahanHarga = {
  @foreach($bahans as $b)
  {{ $b->id }}: {{ (float) $b->harga_beli }},
  @endforeach
};

function pembelianForm() {
  return {
    showNewSupplier: false,
    items: [{ bahan_id: '', qty: 1, harga: 0, subtotal: 0 }],

    get grandTotal() {
      return this.items.reduce((s, i) => s + (i.subtotal || 0), 0);
    },
    setDefaultHarga(idx) {
      const bid = this.items[idx].bahan_id;
      if (bid && bahanHarga[bid]) {
        this.items[idx].harga = bahanHarga[bid];
        this.calcItem(idx);
      }
    },
    calcItem(idx) {
      const item = this.items[idx];
      item.subtotal = (item.qty || 0) * (item.harga || 0);
    },
    addItem() {
      this.items.push({ bahan_id: '', qty: 1, harga: 0, subtotal: 0 });
    },
    removeItem(idx) {
      if (this.items.length > 1) this.items.splice(idx, 1);
    },
    formatNum(n) {
      return Math.round(n || 0).toLocaleString('id-ID');
    },
    async submitQuickSupplier() {
      const data = {
        nama:   document.getElementById('qs-nama').value,
        alamat: document.getElementById('qs-alamat').value,
        tlp:    document.getElementById('qs-tlp').value,
      };
      const res = await fetch('{{ route('master.supplier.quick') }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(data),
      });
      const json = await res.json();
      if (json.success) {
        const sel = document.getElementById('supplier_id');
        const opt = document.createElement('option');
        opt.value = json.supplier.id;
        opt.text  = json.supplier.no_supplier + ' - ' + json.supplier.nama;
        opt.selected = true;
        sel.appendChild(opt);
        this.showNewSupplier = false;
      }
    },
  };
}
</script>
@endpush
