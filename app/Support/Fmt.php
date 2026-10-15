<?php

namespace App\Support;

use Carbon\Carbon;

class Fmt
{
    /**
     * Format nominal Rupiah: Rp 10.000.000
     */
    public static function rp(float|int|string|null $nominal): string
    {
        $value = (float) ($nominal ?? 0);
        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    /**
     * Format tanggal Indonesia: 15 Oktober 2026
     */
    public static function tgl(mixed $date, string $format = 'd F Y'): string
    {
        if (empty($date)) {
            return '-';
        }

        $bulan = [
            1  => 'Januari', 2  => 'Februari', 3  => 'Maret',
            4  => 'April',   5  => 'Mei',       6  => 'Juni',
            7  => 'Juli',    8  => 'Agustus',   9  => 'September',
            10 => 'Oktober', 11 => 'November',  12 => 'Desember',
        ];

        try {
            $carbon = $date instanceof Carbon ? $date : Carbon::parse($date);
            $day    = $carbon->format('d');
            $month  = $bulan[(int) $carbon->format('n')];
            $year   = $carbon->format('Y');
            return "{$day} {$month} {$year}";
        } catch (\Throwable) {
            return '-';
        }
    }

    /**
     * Format tanggal pendek: 15 Okt 2026
     */
    public static function tglPendek(mixed $date): string
    {
        if (empty($date)) {
            return '-';
        }

        $bulan = [
            1  => 'Jan', 2  => 'Feb', 3  => 'Mar',
            4  => 'Apr', 5  => 'Mei', 6  => 'Jun',
            7  => 'Jul', 8  => 'Agt', 9  => 'Sep',
            10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        try {
            $carbon = $date instanceof Carbon ? $date : Carbon::parse($date);
            $day    = $carbon->format('d');
            $month  = $bulan[(int) $carbon->format('n')];
            $year   = $carbon->format('Y');
            return "{$day} {$month} {$year}";
        } catch (\Throwable) {
            return '-';
        }
    }
}
