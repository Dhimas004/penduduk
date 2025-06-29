<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property M_PembaruanData $M_PembaruanData
 */

class Rt extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_PembaruanData'); // Tambahkan baris ini
	}

	public function accPembaruanData()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		// Load model
		$this->load->model('M_PembaruanData');

		// Ambil data pengajuan yang statusnya 'pending'
		$data['judul'] = 'ACC Pembaruan Data';
		$data['user'] = $user;
		$data['pembaruan'] = $this->M_PembaruanData->getAllPending();

		$this->load->view('include/header', $data);
		$this->load->view('rt/acc_pembaruan_data', $data);
		$this->load->view('include/footer');
	}

	public function setujui($id)
	{
		$pengajuan = $this->M_PembaruanData->getPengajuanById($id); // hasilnya object

		if ($pengajuan) {
			// Siapkan data untuk update ke tabel utama
			$dataUpdate = [
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
				'nama_anak_5'       => $pengajuan->nama_anak_5,
				'berkas'            => $pengajuan->berkas,
			];

			// Update ke data_warga
			$this->db->where('idWarga', $pengajuan->id_warga);
			$this->db->update('data_warga', $dataUpdate);

			// Tandai bahwa data ini sudah di-ACC RT
			$this->db->where('id', $id);
			$this->db->update('data_warga_pembaruan', ['status_acc' => 'disetujui']);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil disetujui!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ditemukan.</div>');
		}

		redirect('rt/accPembaruanData');
	}


	public function tolak($id)
	{
		$this->db->delete('data_warga_pembaruan', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-warning">Pengajuan ditolak dan dihapus.</div>');
		redirect('rt/accPembaruanData');
	}
}
