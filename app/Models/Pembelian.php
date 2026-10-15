<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasAutoNumber;

    protected $table    = 'pembelian';
    protected $fillable = ['no_beli', 'supplier_id', 'user_id', 'no_faktur', 'tgl_beli', 'total_beli'];

    protected function casts(): array
    {
        return [
            'tgl_beli'   => 'date',
            'total_beli' => 'decimal:2',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailBeli::class);
    }
}
