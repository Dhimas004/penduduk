<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        // Memisahkan tanggal dan waktu jika ada
        $datetime = explode(' ', $tanggal);
        $tanggal_only = $datetime[0];
        $time = isset($datetime[1]) ? $datetime[1] : '';

        // Memisahkan tanggal (YYYY-MM-DD)
        $pecahkan = explode('-', $tanggal_only);

        // Format tanggal Indonesia
        $tgl_indo = $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];

        // Menambahkan waktu jika ada
        return $time ? $tgl_indo . ' ' . $time : $tgl_indo;
    }
}
