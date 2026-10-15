<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table    = 'pembayaran';
    protected $fillable = ['invoice_id', 'tanggal', 'jumlah', 'user_id'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah'  => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
