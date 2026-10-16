<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasAutoNumber;

    protected $table = 'pelanggan';

    protected $fillable = ['no_pelanggan', 'nama', 'tlp', 'alamat', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Apakah pelanggan sudah digunakan di transaksi penjualan?
     */
    public function digunakan(): bool
    {
        return $this->penjualans()->exists();
    }

    public function getNamaPelangganAttribute(): string
    {
        return $this->nama;
    }

    public function getTelpAttribute(): ?string
    {
        return $this->tlp;
    }
}
