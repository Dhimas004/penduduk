<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Input $input
 * @property M_PembaruanData $M_PembaruanData
 * @property M_Kas $m_kas
 * @property CI_Upload $upload
 */

class Warga extends CI_Controller
{

	private $jumlah_pending = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_PembaruanData');

		// Ambil session user
		$user = $this->session->userdata('user');

		// Hitung jumlah pending hanya jika user login sebagai warga
		if ($user && isset($user['idWarga']) && $user['idWarga'] != '0') {
			$this->jumlah_pending = $this->M_PembaruanData->countPengajuanByWarga($user['idWarga']);
		}
	}

	public function index()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$filter = [
			'nik' => $this->input->get('nik', TRUE),
			'nama' => $this->input->get('nama', TRUE),
			'jekel' => $this->input->get('jekel', TRUE),
			'tanggal_lahir' => $this->input->get('tanggal_lahir', TRUE),
			'tempat_lahir' => $this->input->get('tempat_lahir', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'rt_rw' => $this->input->get('rt_rw', TRUE),
			'status_perkawinan' => $this->input->get('status_perkawinan', TRUE),
		];

		$data['warga'] = $this->m_kas->getWarga('', $filter);

		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
				$this->load->view('include/header', $data);
				$this->load->view('admin/warga', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('warga/warga', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'warga';
				$data['judul'] = 'Data Warga';
				$data['user'] = $user;
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

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah!</div>');
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

	public function cariWarga()
	{

		$data['judul'] = 'Cari Warga';
		$data['query'] = $this->m_kas->getWarga();
		$data['konten'] = 'cariWarga';
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['user'] = $user;

		$this->load->view('include/header', $data);
		$this->load->view('warga/cariWarga', $data);
		$this->load->view('include/footer');
	}

	public function pembaruanData()
	{
		$data['judul'] = 'Pembaruan Data';

		$data['konten'] = 'pembaruanData';
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['user'] = $user;
		if ($user['idWarga'] != '0') $data['dataWarga'] = $this->m_kas->getWarga($user['idWarga'])[0];
		if ($user['role_id'] == 1) {
			// RT
			$this->load->view('include/header', $data);
		} else if ($user['role_id'] == 5) {
			// Bendahara
			$this->load->view('include/header_bendahara', $data);
		} else if ($user['role_id'] == 4) {
			// Warga
			$this->load->view('include/header_warga', $data);
		}

		$this->load->view('warga/pembaruanData', $data);
		$this->load->view('include/footer');
	}

	public function pembaruanDataAction()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		// Cek apakah user login dan punya idWarga
		if (!$user || $user['idWarga'] == '0') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses tidak valid.</div>');
			redirect('warga');
			return;
		}

		$this->load->model('M_PembaruanData');

		$data = [
			'id_warga'          => $user['idWarga'],
			'nik'               => $this->input->post('nik', true),
			'nama'              => $this->input->post('nama', true),
			'jekel'             => $this->input->post('jekel', true),
			'tempat_lahir'      => $this->input->post('tempat_lahir', true),
			'tanggal_lahir'     => $this->input->post('tanggal_lahir', true),
			'alamat'            => $this->input->post('alamat', true),
			'rt_rw'             => $this->input->post('rt_rw', true),
			'status_perkawinan' => $this->input->post('status_perkawinan', true),
			'nama_pasangan'     => $this->input->post('nama_pasangan', true),
			'nama_anak_1'       => $this->input->post('nama_anak_1', true),
			'nama_anak_2'       => $this->input->post('nama_anak_2', true),
			'nama_anak_3'       => $this->input->post('nama_anak_3', true),
			'nama_anak_4'       => $this->input->post('nama_anak_4', true),
			'nama_anak_5'       => $this->input->post('nama_anak_5', true),
			'status_acc'        => 'pending',
			'tanggal_pengajuan' => date('Y-m-d H:i:s')
		];

		// Upload PDF jika ada
		if (!empty($_FILES['berkas']['name'])) {
			$upload_path = './uploads/berkas/';
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0755, true);
			}

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'pdf';
			$config['max_size']      = 2048;
			$config['file_name']     = 'berkas_' . time();

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('berkas')) {
				$uploadData = $this->upload->data();
				$data['berkas'] = $uploadData['file_name'];
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				redirect('warga/pembaruanData');
				return;
			}
		}

		$this->M_PembaruanData->insertPembaruan($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembaruan data berhasil dikirim dan menunggu persetujuan RT.</div>');
		redirect('warga');
	}



	public function ubahDataDiri()
	{
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['user'] = $user;
		$data['dataWarga'] = [];
		if ($user['idWarga'] != '0') $data['dataWarga'] = $this->m_kas->getWarga($user['idWarga']);
		if ($username == '') {
			redirect('auth');
		} else {


			if ($user['role_id'] == 1) {
				// RT
				$data['judul'] = 'Ubah Data Diri';
				$this->load->view('include/header', $data);
				$this->load->view('warga/ubah_data_diri', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				// Bendahara
				$data['judul'] = 'Ubah Data Diri';
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('warga/ubah_data_diri', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 4) {
				// Warga
				$data['judul'] = 'Ubah Data Diri';
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/ubah_data_diri', $data);
				$this->load->view('include/footer');
			}
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
		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data['warga'] = $this->m_kas->getWarga($user['idWarga']);
		$data['idKas'] = $idNow;
		$data['judul'] = "Pembayaran Kas";
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

	public function pembayaranKasAction()
	{
		// Konfigurasi Upload File
		$config['upload_path']   = './assets/uploads/bukti_pembayaran/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size']      = 2048; // Maksimal 2MB
		$config['encrypt_name']  = TRUE; // Nama file akan diacak

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('buktiPembayaran')) {
			// Jika upload berhasil
			$uploadData = $this->upload->data();
			$buktiPembayaran = $uploadData['file_name'];
		} else {
			// Jika upload gagal
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
			redirect('warga/pembayaranKas');
			return;
		}

		// Data untuk disimpan
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'idWarga' => $this->input->post('idWarga'),
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
			'buktiPembayaran' => $buktiPembayaran // Simpan nama file bukti pembayaran
		];

		// Simpan data ke database
		$this->m_kas->saveKas($data);

		// Pesan sukses
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga/pembayaranKas');
	}

	public function PembayaranSampah()
	{

		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data = [];
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data['warga'] = $this->m_kas->getWarga($user['idWarga']);
		$data['idKas'] = $idNow;
		$data['judul'] = "Pembayaran Sampah";
		$data['user'] = $user;
		$data['kas'] = $this->m_kas->getKasByIdWarga($user['idWarga']);
		if ($username == '') {
			redirect('auth');
		} else {
			$this->load->view('include/header_warga', $data);
			$this->load->view('warga/pembayaranSampah', $data);
			$this->load->view('include/footer');
		}
	}

	public function pembayaranSampahAction()
	{
		// Konfigurasi Upload File
		$config['upload_path']   = './assets/uploads/bukti_pembayaran/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size']      = 2048; // Maksimal 2MB
		$config['encrypt_name']  = TRUE; // Nama file akan diacak

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('buktiPembayaran')) {
			// Jika upload berhasil
			$uploadData = $this->upload->data();
			$buktiPembayaran = $uploadData['file_name'];
		} else {
			// Jika upload gagal
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
			redirect('warga/pembayaranSampah');
			return;
		}

		// Data untuk disimpan
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'idWarga' => $this->input->post('idWarga'),
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
			'buktiPembayaran' => $buktiPembayaran // Simpan nama file bukti pembayaran
		];

		// Simpan data ke database
		$this->m_kas->saveKas($data);

		// Pesan sukses
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('warga/PembayaranSampah');
	}
}

/* End of file Controllername.php */
