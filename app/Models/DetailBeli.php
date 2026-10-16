<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBeli extends Model
{
    protected $table = 'detail_beli';

    protected $fillable = ['pembelian_id', 'bahan_id', 'qty', 'harga_satuan_saat_transaksi', 'subtotal'];

    protected function casts(): array
    {
        return [
            'qty' => 'decimal:2',
            'harga_satuan_saat_transaksi' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function bahan()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_id');
    }
}
