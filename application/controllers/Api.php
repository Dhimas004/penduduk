<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // API menampilkan HTML langsung
    public function laporan_pembayaran_sampah_perbulan()
    {
        $tahun = $this->input->get('tahun');
        $data['warga'] = $this->m_kas->getWarga();
        $data['pembayaran'] = [];
        $data['tahun'] = $tahun;

        foreach ($this->m_kas->getPembayaranSampahByTahun($tahun) as $r) {
            $data['pembayaran'][] = $r->idWarga . date_format(date_create($r->tanggal), 'Y-m');
        }

        // Load view laporan dengan data
        $this->load->view('api/laporan_pembayaran_sampah_perbulan', $data);
    }
}
