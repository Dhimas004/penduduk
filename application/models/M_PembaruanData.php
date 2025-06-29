<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_PembaruanData extends CI_Model
{
    // Simpan pengajuan pembaruan data ke tabel sementara
    public function insertPembaruan($data)
    {
        return $this->db->insert('data_warga_pembaruan', $data);
    }

    // Ambil semua pengajuan yang belum disetujui (untuk RT)
    public function getPengajuanPending()
    {
        return $this->db->where('status_acc', 'pending')
            ->join('data_warga', 'data_warga.idWarga = data_warga_pembaruan.id_warga')
            ->order_by('tanggal_pengajuan', 'DESC')
            ->get('data_warga_pembaruan')
            ->result();
    }

    // Ambil satu pengajuan berdasarkan ID
    public function getPengajuanById($id)
    {
        return $this->db->get_where('data_warga_pembaruan', ['id' => $id])->row();
    }

    // ACC: update data utama dan ubah status pengajuan
    public function accPengajuan($id)
    {
        $pengajuan = $this->getPengajuanById($id);
        if (!$pengajuan) return false;

        // Update data_warga
        $update = [
            'nik'               => $pengajuan->nik,
            'nama'              => $pengajuan->nama,
            'jekel'             => $pengajuan->jekel,
            'tempat_lahir'      => $pengajuan->tempat_lahir,
            'tanggal_lahir'     => $pengajuan->tanggal_lahir,
            'alamat'            => $pengajuan->alamat,
            'rt_rw'             => $pengajuan->rt_rw,
            'status_perkawinan' => $pengajuan->status_perkawinan,
            'nama_pasangan'     => $pengajuan->nama_pasangan,
            'nama_anak_1'       => $pengajuan->nama_anak_1,
            'nama_anak_2'       => $pengajuan->nama_anak_2,
            'nama_anak_3'       => $pengajuan->nama_anak_3,
            'nama_anak_4'       => $pengajuan->nama_anak_4,
            'nama_anak_5'       => $pengajuan->nama_anak_5
        ];

        $this->db->where('idWarga', $pengajuan->id_warga)->update('data_warga', $update);
        $this->db->where('id', $id)->update('data_warga_pembaruan', ['status_acc' => 'disetujui']);
        return true;
    }

    // Tolak pengajuan
    public function tolakPengajuan($id)
    {
        return $this->db->where('id', $id)->update('data_warga_pembaruan', ['status_acc' => 'ditolak']);
    }

    // Ambil semua pengajuan milik warga tertentu
    public function getPengajuanByWarga($id_warga)
    {
        return $this->db->where('id_warga', $id_warga)
            ->order_by('tanggal_pengajuan', 'DESC')
            ->get('data_warga_pembaruan')
            ->result();
    }

    public function countPengajuanByWarga($idWarga)
    {
        return $this->db->where('id_warga', $idWarga)
            ->where('status_acc', 'pending')
            ->count_all_results('data_warga_pembaruan');
    }

    public function countPendingByRt($rt_rw)
    {
        return $this->db->where('status_acc', 'pending')
            ->where('rt_rw', $rt_rw)
            ->count_all_results('data_warga_pembaruan');
    }

    public function countAllPending()
    {
        return $this->db->where('status_acc', 'pending')
            ->count_all_results('data_warga_pembaruan');
    }

    public function getAllPending()
    {
        return $this->db->get_where('data_warga_pembaruan', ['status_acc' => 'pending'])->result_array();
    }

    public function updateDataWarga($data)
    {
        $this->db->where('idWarga', $data['id_warga']);
        return $this->db->update('data_warga', [
            'nik'               => $data['nik'],
            'nama'              => $data['nama'],
            'jekel'             => $data['jekel'],
            'tempat_lahir'      => $data['tempat_lahir'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'rt_rw'             => $data['rt_rw'],
            'status_perkawinan' => $data['status_perkawinan'],
            'nama_pasangan'     => $data['nama_pasangan'],
            'nama_anak_1'       => $data['nama_anak_1'],
            'nama_anak_2'       => $data['nama_anak_2'],
            'nama_anak_3'       => $data['nama_anak_3'],
            'nama_anak_4'       => $data['nama_anak_4'],
            'nama_anak_5'       => $data['nama_anak_5'],
        ]);
    }

    public function hapusPengajuan($id_warga)
    {
        $this->db->delete('data_warga_pembaruan', ['id_warga' => $id_warga]);
    }
}
