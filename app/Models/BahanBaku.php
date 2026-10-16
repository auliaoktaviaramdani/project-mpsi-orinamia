<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasAutoNumber;

    protected $table = 'bahan_baku';

    protected $fillable = ['no_bahan', 'nama_bahan', 'satuan', 'harga_beli', 'is_active'];

    protected function casts(): array
    {
        return [
            'harga_beli' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function detailBelis()
    {
        return $this->hasMany(DetailBeli::class, 'bahan_id');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function digunakan(): bool
    {
        return $this->detailBelis()->exists();
    }
}
