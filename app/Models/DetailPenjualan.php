<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';

    protected $fillable = ['penjualan_id', 'nama_item', 'ukuran', 'qty', 'harga_satuan', 'subtotal'];

    protected function casts(): array
    {
        return [
            'harga_satuan' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
