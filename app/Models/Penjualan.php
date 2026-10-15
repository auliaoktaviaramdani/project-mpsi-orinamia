<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasAutoNumber;

    protected $table    = 'penjualan';
    protected $fillable = [
        'no_jual', 'pelanggan_id', 'user_id',
        'tgl_jual', 'total', 'paid', 'balance_due', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tgl_jual'    => 'date',
            'total'       => 'decimal:2',
            'paid'        => 'decimal:2',
            'balance_due' => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoiceDP()
    {
        return $this->hasOne(Invoice::class)->where('jenis', 'DP');
    }

    public function invoicePelunasan()
    {
        return $this->hasOne(Invoice::class)->where('jenis', 'PELUNASAN');
    }

    // -------------------------------------------------------------------------
    // Business Logic
    // -------------------------------------------------------------------------

    /**
     * Hitung ulang paid, balance_due, dan status dari data pembayaran aktual.
     * BELUM_BAYAR -> DP_LUNAS -> LUNAS (TERKIRIM hanya diset manual).
     */
    public function recalculateTotalsAndStatus(): void
    {
        $this->loadMissing('invoices.pembayarans');

        $totalPaid = 0;
        foreach ($this->invoices as $invoice) {
            $invoice->refresh();
            $invPaid = $invoice->pembayarans->sum('jumlah');

            if ($invPaid >= $invoice->jumlah) {
                $invoice->status = 'LUNAS';
            } else {
                $invoice->status = 'BELUM_BAYAR';
            }
            $invoice->save();

            $totalPaid += $invPaid;
        }

        $this->paid        = $totalPaid;
        $this->balance_due = max(0, $this->total - $totalPaid);

        // Tentukan status penjualan (jangan turunkan dari TERKIRIM)
        if ($this->status !== 'TERKIRIM') {
            $dpInvoice = $this->invoiceDP;
            $lnInvoice = $this->invoicePelunasan;

            if ($lnInvoice && $lnInvoice->status === 'LUNAS') {
                $this->status = 'LUNAS';
            } elseif ($dpInvoice && $dpInvoice->status === 'LUNAS') {
                $this->status = 'DP_LUNAS';
            } else {
                $this->status = 'BELUM_BAYAR';
            }
        }

        $this->save();
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopeByStatus($query, string $status)
    {
        if ($status && $status !== 'ALL') {
            return $query->where('status', $status);
        }
        return $query;
    }
}
