<?php

namespace App\Models;

use App\Models\Concerns\HasAutoNumber;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasAutoNumber;

    protected $table = 'supplier';

    protected $fillable = ['no_supplier', 'nama', 'alamat', 'tlp', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function digunakan(): bool
    {
        return $this->pembelians()->exists();
    }
}
