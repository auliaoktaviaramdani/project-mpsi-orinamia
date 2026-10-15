<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasAutoNumber;

    protected $table    = 'invoice';
    protected $fillable = ['penjualan_id', 'jenis', 'nomor', 'jumlah', 'jatuh_tempo', 'status'];

    protected function casts(): array
    {
        return [
            'jumlah'      => 'decimal:2',
            'jatuh_tempo' => 'date',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function totalPaid(): float
    {
        return (float) $this->pembayarans->sum('jumlah');
    }

    public function sisaTagihan(): float
    {
        return max(0, (float) $this->jumlah - $this->totalPaid());
    }
}
