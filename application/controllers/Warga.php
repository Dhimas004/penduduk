<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

	public function index()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header', $data);
				$this->load->view('admin/warga', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('warga/warga', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
				$data['user'] = $user;
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/warga', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function addWarga()
	{
		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'rt_rw' => $this->input->post('rt_rw'),
			'status_perkawinan' => $this->input->post('status_perkawinan'),
			'nama_pasangan' => $this->input->post('nama_pasangan'),
			'nama_anak_1' => $this->input->post('nama_anak_1'),
			'nama_anak_2' => $this->input->post('nama_anak_2'),
			'nama_anak_3' => $this->input->post('nama_anak_3'),
			'nama_anak_4' => $this->input->post('nama_anak_4'),
			'nama_anak_5' => $this->input->post('nama_anak_5'),
		];
		$this->m_kas->saveWarga($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga');
	}

	public function editWarga()
	{
		$idWarga = $this->input->post('idWarga');
		$data = [
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'jekel' => $this->input->post('jekel'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'rt_rw' => $this->input->post('rt_rw'),
			'status_perkawinan' => $this->input->post('status_perkawinan'),
			'nama_pasangan' => $this->input->post('nama_pasangan'),
			'nama_anak_1' => $this->input->post('nama_anak_1'),
			'nama_anak_2' => $this->input->post('nama_anak_2'),
			'nama_anak_3' => $this->input->post('nama_anak_3'),
			'nama_anak_4' => $this->input->post('nama_anak_4'),
			'nama_anak_5' => $this->input->post('nama_anak_5'),
		];
		$this->m_kas->updateWarga($data, $idWarga);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		$url = $this->input->post('url');
		if (isset($url) && $url == 'ubahDataDiri') {
			redirect('warga/ubahDataDiri');
		} else {
			redirect('warga');
		}
	}

	public function delWarga($idWarga)
	{
		$this->m_kas->delWarga($idWarga);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('warga');
	}

	public function lapWarga()
	{
		$data['judul'] = 'Laporan Data Warga';
		$data['query'] = $this->m_kas->getWarga();
		$data['konten'] = 'lap_warga';
		$this->load->view('laporan/lap_warga', $data);
	}

	public function ubahDataDiri()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['user'] = $user;
		$data['dataWarga'] = [];
		if ($user['idWarga'] != '0') $data['dataWarga'] = $this->m_kas->getWarga($user['idWarga']);
		if ($username == '') {
			redirect('auth');
		} else {
			$data['judul'] = 'Ubah Data Diri';
			$this->load->view('include/header_warga', $data);
			$this->load->view('warga/ubah_data_diri', $data);
			$this->load->view('include/footer');
		}
	}

	public function detailWarga($idWarga)
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['judul'] = 'Detail Warga';
				$data['query'] = $this->m_kas->getWarga();
				$data['user'] = $user;
				$data['detailWarga'] = $this->m_kas->getWarga($idWarga);
				$this->load->view('include/header', $data);
				$this->load->view('warga/detail_warga', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 3) {
				$data['judul'] = 'Detail Warga';
				$data['query'] = $this->m_kas->getWarga();
				$data['konten'] = 'lap_warga';
				$data['user'] = $user;
				$data['detailWarga'] = $this->m_kas->getWarga($idWarga);
				$this->load->view('include/header_1', $data);
				$this->load->view('warga/detail_warga', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 2) {
				$data['judul'] = 'Detail Warga';
				$data['query'] = $this->m_kas->getWarga();
				$data['konten'] = 'lap_warga';
				$data['user'] = $user;
				$data['detailWarga'] = $this->m_kas->getWarga($idWarga);
				$this->load->view('include/header_1', $data);
				$this->load->view('warga/detail_warga', $data);
				$this->load->view('include/footer');
			} else {
				$data['judul'] = 'Detail Warga';
				$data['query'] = $this->m_kas->getWarga();
				$data['konten'] = 'lap_warga';
				$data['user'] = $user;
				$data['detailWarga'] = $this->m_kas->getWarga($idWarga);
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/detail_warga', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function pembayaranKas()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data = [];
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$data['user'] = $user;
		$data['kas'] = $this->m_kas->getKasByIdWarga($user['idWarga']);
		if ($username == '') {
			redirect('auth');
		} else {
			$this->load->view('include/header_warga', $data);
			$this->load->view('warga/pembayaranKas', $data);
			$this->load->view('include/footer');
		}
	}
}

/* End of file Controllername.php */
