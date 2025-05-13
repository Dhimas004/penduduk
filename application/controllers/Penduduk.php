<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load model M_kas di dalam konstruktor
		$this->load->model('M_kas');
	}

	public function index()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data = array('idKas' => $idNow);
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}


		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Kas Masuk';
				$data['judul'] = 'Kas Masuk';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalMasuk();
				$data['masuk'] = $this->m_kas->getKasMasuk();
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header', $data);
				$this->load->view('admin/kasMasuk', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Kas Masuk';
				$data['judul'] = 'Kas Masuk';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalMasuk();
				$data['masuk'] = $this->m_kas->getKasMasuk();
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/kasMasuk', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'Kas Masuk';
				$data['judul'] = 'Kas Masuk';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalMasuk();
				$data['masuk'] = $this->m_kas->getKasMasuk();
				$this->load->view('include/header_1', $data);
				$this->load->view('rt/kasMasuk', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function sampah()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$cekId = $this->m_kas->cekNomorSampah();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data = array('idSampah' => $idNow);
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}

		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Kas Masuk';
				$data['judul'] = 'Kas Masuk';
				$data['user'] = $user;
				$data['sampah'] = $this->m_kas->getSampah();
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header', $data);
				$this->load->view('admin/sampah', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Kas Masuk';
				$data['judul'] = 'Kas Masuk';
				$data['user'] = $user;
				$data['sampah'] = $this->m_kas->getSampah();
				$data['warga'] = $this->m_kas->getWarga();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/sampah', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function addPembayaranSampah()
	{
		$this->m_kas->cekNomor();
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'status' => $this->input->post('status'),
			'keterangan' => 'Pembayaran Sampah',
			'jenis' => 'masuk',
			'idWarga' => $this->input->post('idWarga'),
		];
		$this->m_kas->saveKas($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect('penduduk/sampah');
	}

	public function editPembayaranSampah()
	{
		$idKas = $this->input->post('idKas');
		$data = [
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'idWarga' => $this->input->post('idWarga'),
			'jenis' => 'masuk',
		];
		$this->m_kas->updateKas($data, $idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
		redirect('penduduk/sampah');
	}

	public function kasKeluar()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$cekId = $this->m_kas->cekNomor();
		$getId = substr($cekId, 4, 4);
		$idNow = $getId + 1;
		$data = array('idKas' => $idNow);

		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Kas Keluar';
				$data['judul'] = 'Kas Keluar';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalKeluar();
				$data['keluar'] = $this->m_kas->getKasKeluar();
				$this->load->view('include/header', $data);
				$this->load->view('admin/kasKeluar', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Kas Keluar';
				$data['judul'] = 'Kas Keluar';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalKeluar();
				$data['keluar'] = $this->m_kas->getKasKeluar();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('bendahara/kasKeluar', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'Kas Keluar';
				$data['judul'] = 'Kas Keluar';
				$data['user'] = $user;
				$data['ttl'] = $this->m_kas->TotalKeluar();
				$data['keluar'] = $this->m_kas->getKasKeluar();
				$this->load->view('include/header_1', $data);
				$this->load->view('rt/kasKeluar', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function addKas()
	{
		$this->m_kas->cekNomor();
		$data = [
			'idKas' => $this->input->post('id_kas'),
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
			'idWarga' => $this->input->post('idWarga'),
		];
		$this->m_kas->saveKas($data);
		if ('jenis' == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
			redirect('penduduk');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
			redirect('penduduk/kasKeluar');
		}
	}

	public function editKas()
	{
		$idKas = $this->input->post('idKas');
		$data = [
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis' => $this->input->post('jenis'),
			'idWarga' => $this->input->post('idWarga'),
		];
		$this->m_kas->updateKas($data, $idKas);
		if ('jenis' == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('penduduk');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('penduduk');
		}
	}

	public function delKas($idKas)
	{
		$this->m_kas->delKas($idKas);
		if ('jenis' == 'masuk') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('penduduk');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('penduduk/kasKeluar');
		}
	}

	public function laporan()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['debit'] = $this->m_kas->getKasMasuk();
				$data['kredit'] = $this->m_kas->getKasKeluar();
				$data['kas'] = $this->m_kas->getKas([
					'order_by' => 'tanggal',
					'order_dir' => 'DESC',
					'status' => 'kas',
				]);
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header', $data);
				$this->load->view('admin/laporan', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['debit'] = $this->m_kas->getKasMasuk();
				$data['kredit'] = $this->m_kas->getKasKeluar();
				$data['kas'] = $this->m_kas->getKas([
					'order_by' => 'tanggal',
					'order_dir' => 'DESC',
					'status' => 'kas'
				]);
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/laporan', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['kas'] = $this->m_kas->getKas();
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/laporan', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function laporanSampah()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['debit'] = $this->m_kas->getKasMasuk();
				$data['kredit'] = $this->m_kas->getKasKeluar();
				$data['kas'] = $this->m_kas->getKas([
					'order_by' => 'tanggal',
					'order_dir' => 'DESC',
					'status' => 'sampah',
					'status_persetujuan' => '1'
				]);
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header', $data);
				$this->load->view('admin/laporanSampah', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['debit'] = $this->m_kas->getKasMasuk();
				$data['kredit'] = $this->m_kas->getKasKeluar();
				$data['kas'] = $this->m_kas->getKas([
					'order_by' => 'tanggal',
					'order_dir' => 'DESC',
					'status' => 'sampah'
				]);
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/laporanSampah', $data);
				$this->load->view('include/footer');
			} else {
				$data['menu'] = 'Laporan';
				$data['judul'] = 'Laporan';
				$data['user'] = $user;
				$data['kas'] = $this->m_kas->getKas([
					'order_by' => 'tanggal',
					'order_dir' => 'DESC',
					'status' => 'sampah'
				]);
				$data['masuk'] = $this->m_kas->TotalMasuk();
				$data['keluar'] = $this->m_kas->TotalKeluar();
				$this->load->view('include/header_warga', $data);
				$this->load->view('warga/laporanSampah', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function lapKas()
	{
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$data['judul'] = 'Laporan';
		$data['kas'] = $this->M_kas->getKas([
			'order_by' => 'tanggal',
			'order_dir' => 'DESC',
			'status' => 'kas'
		]);
		$data['konten'] = 'lap_kas';
		$this->load->view('laporan/lap_kas', $data);
	}

	public function lapSampah()
	{
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$data['judul'] = 'Laporan';
		$data['kas'] = $this->M_kas->getKas([
			'order_by' => 'tanggal',
			'order_dir' => 'DESC',
			'status' => 'sampah'
		]);
		$data['konten'] = 'lap_kas';
		$this->load->view('laporan/lap_kas', $data);
	}

	public function laporanPembayaranSampahPerbulan()
	{

		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['judul'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['user'] = $user;
				$this->load->view('include/header', $data);
				$this->load->view('admin/laporan_pembayaran_sampah_perbulan', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['judul'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['user'] = $user;
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/laporan_pembayaran_sampah_perbulan', $data);
				$this->load->view('include/footer');
			}
		}
	}

	public function setujuiPembayaranSampah()
	{

		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$data['namaWarga'] = []; // Array untuk menyimpan nama warga
		foreach ($this->m_kas->getWarga() as $w) {
			$data['namaWarga'][$w->idWarga] = ucwords(strtolower($w->nama));
		}
		$data['pembayaranSampah'] = $this->M_kas->getPembayaranSampahBelumDisetujui();
		if ($username == '') {
			redirect('auth');
		} else {
			if ($user['role_id'] == 1) {
				$data['menu'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['judul'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['user'] = $user;
				$this->load->view('include/header', $data);
				$this->load->view('admin/setujui_pembayaran_sampah', $data);
				$this->load->view('include/footer');
			} else if ($user['role_id'] == 5) {
				$data['menu'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['judul'] = 'Laporan Pembayaran Sampah Perbulan';
				$data['user'] = $user;
				$this->load->view('include/header_bendahara', $data);
				$this->load->view('admin/setujui_pembayaran_sampah', $data);
				$this->load->view('include/footer');
			}
		}
	}


	public function setujuiPembayaranSampahAction()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$idKas = $this->input->post('idKas');
		$data = [
			'status_persetujuan' => 1,
			'tanggal_persetujuan' => date('Y-m-d H:i:s'),
			'user_id_persetujuan' => $user['user_id'],
		];
		$this->m_kas->updateKas($data, $idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disetujui!</div>');
		redirect('penduduk/sampah');
	}

	public function tolakPembayaranSampahAction()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$idKas = $this->input->post('idKas');
		$data = [
			'status_persetujuan' => 2,
			'tanggal_persetujuan' => date('Y-m-d H:i:s'),
			'user_id_persetujuan' => $user['user_id'],
			'alasan_penolakan' => $this->input->post('alasan_penolakan'),
		];
		$this->m_kas->updateKas($data, $idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditolak!</div>');
		redirect('penduduk/sampah');
	}

	public function setujuiPembayaranKasAction()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$idKas = $this->input->post('idKas');
		$data = [
			'status_persetujuan' => 1,
			'tanggal_persetujuan' => date('Y-m-d H:i:s'),
			'user_id_persetujuan' => $user['user_id'],
		];
		$this->m_kas->updateKas($data, $idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disetujui!</div>');
		redirect('penduduk');
	}

	public function tolakPembayaranKasAction()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$idKas = $this->input->post('idKas');
		$data = [
			'status_persetujuan' => 2,
			'tanggal_persetujuan' => date('Y-m-d H:i:s'),
			'user_id_persetujuan' => $user['user_id'],
			'alasan_penolakan' => $this->input->post('alasan_penolakan'),
		];
		$this->m_kas->updateKas($data, $idKas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditolak!</div>');
		redirect('penduduk');
	}
}

/* End of file Controllername.php */
