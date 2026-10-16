@extends('layouts.simorin')
@section('title', 'Catat Pembelian Bahan')

@section('content')
<div style="max-width:920px;margin:0 auto;" x-data="pembelianForm()">

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

  @if($errors->has('items') || $errors->has('items.*'))
  <div style="padding:12px 16px;background:rgba(239, 68, 68, 0.1);border:1px solid rgba(239, 68, 68, 0.3);border-radius:8px;color:#EF4444;font-size:0.85rem;display:flex;align-items:center;gap:10px;margin-bottom:20px;">
    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
    <div>
      <strong>Perhatian pada item bahan:</strong> Pastikan seluruh baris bahan telah dipilih, kuantitas diisi lebih dari 0, dan harga satuan valid.
    </div>
  </div>
  @endif

  <form action="{{ route('pembelian.store') }}" method="POST" @submit="isSubmitting = true">
    @csrf

    <div style="display:grid;gap:20px;">

      <!-- Info Pembelian (Responsive Grid) -->
      <div class="panel spotlight-card" style="padding:20px;display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:16px;">
        <div>
          <label for="supplier_id" class="form-label">Supplier <span style="color:#EF4444;">*</span></label>
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
          @error('supplier_id')<p style="color:#EF4444;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="tgl_beli" class="form-label">Tanggal Beli <span style="color:#EF4444;">*</span></label>
          <input type="date" name="tgl_beli" id="tgl_beli" class="form-input"
                 value="{{ old('tgl_beli', $today) }}" required>
          @error('tgl_beli')<p style="color:#EF4444;font-size:0.75rem;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="no_faktur" class="form-label">No. Faktur Supplier</label>
          <input type="text" name="no_faktur" id="no_faktur" class="form-input font-num"
                 value="{{ old('no_faktur') }}" placeholder="FK-XXXX (opsional)">
        </div>
      </div>

      <!-- Item Bahan Baku -->
      <div class="panel">
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
          <div style="display:flex;align-items:center;gap:8px;">
            <h2 style="font-weight:700;font-size:0.9375rem;">Item Bahan Baku</h2>
            <span class="badge" style="font-size:0.75rem;" x-text="items.length + ' baris'"></span>
          </div>
          <button type="button" class="btn-outline" style="min-height:36px;padding:4px 12px;font-size:0.75rem;"
                  @click="addItem()" id="btn-tambah-bahan">
            + Tambah Bahan
          </button>
        </div>

        <div style="overflow-x:auto;">
          <table class="tbl" style="width:100%;min-width:680px;border-collapse:collapse;">
            <thead>
              <tr>
                <th>Bahan Baku</th>
                <th style="width:100px;text-align:center;">Satuan</th>
                <th style="width:130px;">Qty</th>
                <th style="width:190px;">Harga Satuan (Rp)</th>
                <th style="text-align:right;width:160px;">Subtotal</th>
                <th style="width:48px;"></th>
              </tr>
            </thead>
            <tbody>
              <template x-for="(item, idx) in items" :key="idx">
                <tr>
                  <td>
                    <select :name="`items[${idx}][bahan_id]`" x-model="item.bahan_id"
                            @change="onBahanChange(idx)" class="form-input" required style="min-height:38px;">
                      <option value="">-- Pilih Bahan Baku --</option>
                      @foreach($bahans as $b)
                      <option value="{{ $b->id }}">
                        {{ $b->no_bahan }} - {{ $b->nama_bahan }} ({{ $b->satuan }})
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td style="text-align:center;">
                    <span class="badge font-num" style="font-size:0.75rem;padding:3px 8px;text-transform:lowercase;"
                          x-text="getSatuan(item.bahan_id) || '-'"></span>
                  </td>
                  <td>
                    <input type="number" :name="`items[${idx}][qty]`" x-model.number="item.qty"
                           @input="calcItem(idx)" class="form-input font-num"
                           min="0.01" step="0.01" required style="min-height:38px;" placeholder="0">
                  </td>
                  <td>
                    <div>
                      <input type="number" :name="`items[${idx}][harga_satuan_saat_transaksi]`"
                             x-model.number="item.harga" @input="calcItem(idx)"
                             class="form-input font-num" min="0" step="100" required style="min-height:38px;" placeholder="0">
                      <div class="font-num" style="font-size:0.7rem;color:var(--muted);margin-top:2px;"
                           x-text="'Rp ' + formatNum(item.harga)"></div>
                    </div>
                  </td>
                  <td style="text-align:right;">
                    <span class="font-num" style="font-weight:700;color:var(--text);" x-text="'Rp ' + formatNum(item.subtotal)"></span>
                  </td>
                  <td style="text-align:center;">
                    <button type="button" @click="removeItem(idx)"
                            style="background:none;border:none;cursor:pointer;color:#EF4444;padding:6px;border-radius:6px;transition:background 150ms;"
                            x-show="items.length > 1"
                            title="Hapus baris bahan"
                            aria-label="Hapus baris bahan">
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

        <div style="padding:16px 20px;background:var(--tint);border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
          <span style="font-size:0.8375rem;color:var(--muted);">Total Nilai Pembelian:</span>
          <span class="font-num" style="font-size:1.35rem;font-weight:700;color:var(--accent);" x-text="'Rp ' + formatNum(grandTotal)"></span>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:10px;">
        <a href="{{ route('pembelian.index') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary" id="btn-simpan-pembelian" :disabled="isSubmitting || grandTotal <= 0">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" x-show="!isSubmitting">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
          <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Pembelian'"></span>
        </button>
      </div>
    </div>
  </form>

  <!-- Modal Supplier Baru -->
  <div x-show="showNewSupplier" x-cloak x-transition class="modal-overlay" style="display:none;"
       @keydown.escape.window="showNewSupplier = false" role="dialog" aria-modal="true" aria-label="Form Supplier Baru">
    <div class="modal-box" @click.stop style="max-width:440px;">
      <h2 style="font-weight:700;font-size:1.125rem;margin-bottom:16px;">Tambah Supplier Baru</h2>

      <template x-if="supplierError">
        <div style="padding:8px 12px;background:rgba(239, 68, 68, 0.1);border:1px solid rgba(239, 68, 68, 0.25);border-radius:6px;color:#EF4444;font-size:0.8rem;margin-bottom:14px;"
             x-text="supplierError"></div>
      </template>

      <form @submit.prevent="submitQuickSupplier()">
        <div style="margin-bottom:12px;">
          <label class="form-label">Nama Supplier <span style="color:#EF4444;">*</span></label>
          <input type="text" id="qs-nama" class="form-input" required placeholder="Nama toko / supplier" autofocus>
        </div>
        <div style="margin-bottom:12px;">
          <label class="form-label">Alamat</label>
          <input type="text" id="qs-alamat" class="form-input" placeholder="Pasar Tanah Abang, Jakarta Pusat">
        </div>
        <div style="margin-bottom:20px;">
          <label class="form-label">No. Telepon</label>
          <input type="text" id="qs-tlp" class="form-input font-num" placeholder="021-xxxxxxx atau 0812xxxx">
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px;">
          <button type="button" class="btn-outline" @click="showNewSupplier = false" :disabled="isSavingSupplier">Batal</button>
          <button type="submit" class="btn-primary" id="btn-simpan-supplier-baru" :disabled="isSavingSupplier">
            <span x-text="isSavingSupplier ? 'Menyimpan...' : 'Simpan Supplier'"></span>
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
const bahanData = {
  @foreach($bahans as $b)
  {{ $b->id }}: { harga: {{ (float) $b->harga_beli }}, satuan: '{{ $b->satuan }}' },
  @endforeach
};

@php
  $oldItems = old('items');
@endphp

const initialItems = @json($oldItems);

function pembelianForm() {
  let defaultItems = [{ bahan_id: '', qty: 1, harga: 0, subtotal: 0 }];
  if (Array.isArray(initialItems) && initialItems.length > 0) {
    defaultItems = initialItems.map(i => {
      const bid = i.bahan_id || '';
      const q = parseFloat(i.qty) || 1;
      const h = parseFloat(i.harga_satuan_saat_transaksi ?? i.harga ?? 0);
      return {
        bahan_id: bid,
        qty: q,
        harga: h,
        subtotal: q * h,
      };
    });
  }

  return {
    isSubmitting: false,
    showNewSupplier: false,
    isSavingSupplier: false,
    supplierError: '',
    items: defaultItems,

    get grandTotal() {
      return this.items.reduce((s, i) => s + (i.subtotal || 0), 0);
    },
    getSatuan(bid) {
      return bid && bahanData[bid] ? bahanData[bid].satuan : '';
    },
    onBahanChange(idx) {
      const bid = this.items[idx].bahan_id;
      if (bid && bahanData[bid]) {
        this.items[idx].harga = bahanData[bid].harga;
        this.calcItem(idx);
      }
    },
    calcItem(idx) {
      const item = this.items[idx];
      item.subtotal = (parseFloat(item.qty) || 0) * (parseFloat(item.harga) || 0);
    },
    addItem() {
      this.items.push({ bahan_id: '', qty: 1, harga: 0, subtotal: 0 });
    },
    removeItem(idx) {
      if (this.items.length > 1) {
        this.items.splice(idx, 1);
      }
    },
    formatNum(n) {
      return Math.round(n || 0).toLocaleString('id-ID');
    },
    async submitQuickSupplier() {
      this.supplierError = '';
      const namaEl = document.getElementById('qs-nama');
      const alamatEl = document.getElementById('qs-alamat');
      const tlpEl = document.getElementById('qs-tlp');

      const nama = (namaEl?.value || '').trim();
      if (!nama) {
        this.supplierError = 'Nama supplier wajib diisi.';
        return;
      }

      this.isSavingSupplier = true;
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const res = await fetch('{{ route('master.supplier.quick') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken || '',
          },
          body: JSON.stringify({
            nama: nama,
            alamat: alamatEl?.value || '',
            tlp: tlpEl?.value || '',
          }),
        });

        const json = await res.json();
        if (res.ok && json.success) {
          const sel = document.getElementById('supplier_id');
          const opt = document.createElement('option');
          opt.value = json.supplier.id;
          opt.text = json.supplier.no_supplier + ' - ' + json.supplier.nama;
          opt.selected = true;
          sel.appendChild(opt);

          if (namaEl) namaEl.value = '';
          if (alamatEl) alamatEl.value = '';
          if (tlpEl) tlpEl.value = '';
          this.showNewSupplier = false;
        } else {
          this.supplierError = json.message || (json.errors ? Object.values(json.errors).flat().join(', ') : 'Gagal menyimpan supplier.');
        }
      } catch (err) {
        this.supplierError = 'Terjadi gangguan koneksi atau server.';
      } finally {
        this.isSavingSupplier = false;
      }
    },
  };
}
</script>
@endpush
