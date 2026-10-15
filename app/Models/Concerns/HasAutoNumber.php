<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;

trait HasAutoNumber
{
    /**
     * Generate nomor urut untuk entitas statis (Pelanggan, Supplier, Bahan Baku).
     * Format: PREFIX-NNN  (e.g. PL-001, SP-001, BB-001)
     */
    protected static function generateStaticNumber(string $prefix, string $column, string $table): string
    {
        $last = DB::table($table)
            ->where($column, 'like', "{$prefix}-%")
            ->orderByDesc($column)
            ->value($column);

        $next = 1;
        if ($last) {
            $parts = explode('-', $last);
            $next  = ((int) end($parts)) + 1;
        }

        return $prefix . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate nomor urut berbasis bulan/tahun (Penjualan, Pembelian, Invoice).
     * Format: PREFIX-YYYYMM-NNN  (e.g. PJ-202610-001)
     */
    protected static function generateMonthlyNumber(string $prefix, string $column, string $table, ?string $period = null): string
    {
        $period = $period ?? now()->format('Ym');

        $last = DB::table($table)
            ->where($column, 'like', "{$prefix}-{$period}-%")
            ->orderByDesc($column)
            ->value($column);

        $next = 1;
        if ($last) {
            $parts = explode('-', $last);
            $next  = ((int) end($parts)) + 1;
        }

        return $prefix . '-' . $period . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // -------------------------------------------------------------------------
    // Shortcut statics per entitas
    // -------------------------------------------------------------------------

    public static function nextNoPelanggan(): string
    {
        return static::generateStaticNumber('PL', 'no_pelanggan', 'pelanggan');
    }

    public static function nextNoSupplier(): string
    {
        return static::generateStaticNumber('SP', 'no_supplier', 'supplier');
    }

    public static function nextNoBahan(): string
    {
        return static::generateStaticNumber('BB', 'no_bahan', 'bahan_baku');
    }

    public static function nextNoPenjualan(?string $period = null): string
    {
        return static::generateMonthlyNumber('PJ', 'no_jual', 'penjualan', $period);
    }

    public static function nextNoPembelian(?string $period = null): string
    {
        return static::generateMonthlyNumber('PB', 'no_beli', 'pembelian', $period);
    }

    public static function nextNoInvoiceDP(?string $period = null): string
    {
        return static::generateMonthlyNumber('INV-DP', 'nomor', 'invoice', $period);
    }

    public static function nextNoInvoicePelunasan(?string $period = null): string
    {
        return static::generateMonthlyNumber('INV-LN', 'nomor', 'invoice', $period);
    }
}
