<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kas extends CI_Model
{

	public function getKas($params = [])
	{
		// Tambahkan filter status jika ada
		if (!empty($params['status'])) {
			$this->db->where('status', $params['status']);
		}

		// Tambahkan filter status_persetujuan jika ada
		if (!empty($params['status_persetujuan'])) {
			$this->db->where('status_persetujuan', $params['status_persetujuan']);
		}

		// Jika idKas diset, ambil satu baris saja
		if (!empty($params['idKas'])) {
			$this->db->where('idKas', $params['idKas']);
			return $this->db->get('data_transaksi')->row_array();
		}

		// Urutan hasil jika diset
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by'], $params['order_dir'] ?? 'ASC');
		}

		// Batas hasil jika diset
		if (!empty($params['limit'])) {
			$this->db->limit($params['limit'], $params['offset'] ?? 0);
		}

		return $this->db->get('data_transaksi')->result();
	}


	public function getPembayaranSampahByTahun($tahun)
	{
		$this->db->where('status', 'sampah');
		$this->db->where('status_persetujuan', '1');
		$this->db->where('YEAR(tanggal)', $tahun);

		return $this->db->get('data_transaksi')->result();
	}

	public function getPembayaranSampahBelumDisetujui()
	{
		// Menyaring berdasarkan status 'sampah' dan status_persetujuan = 0
		$this->db->where('status', 'sampah');
		$this->db->where('status_persetujuan', 0);

		return $this->db->get('data_transaksi')->result();  // Mengembalikan hasil query
	}

	public function getSampah($idKas = '')
	{
		if ($idKas) {
			return $this->db->get('data_transaksi', ['idKas' => $idKas, 'status' => 'sampah'])->row_array();
		} else {
			return $this->db->where('status', 'sampah')->get('data_transaksi')->result();
		}
	}

	public function getSampahByIdWarga($idWarga = '')
	{
		return $this->db
			->where('status', 'sampah')
			->where('idWarga', $idWarga)
			->get('data_transaksi')
			->result();
	}



	public function cekNomor()
	{
		$idKas = $this->db->query("SELECT MAX(idKas) AS id_kas FROM data_transaksi WHERE `status` = 'kas'")->row();
		return $idKas->id_kas;
	}

	public function cekNomorSampah()
	{
		$idSampah = $this->db->query("SELECT MAX(idKas) AS id_sampah FROM data_transaksi WHERE `status` = 'sampah'")->row();
		return $idSampah->id_sampah;
	}

	public function saveKas($data)
	{
		return $this->db->insert('data_transaksi', $data);
	}

	public function updateKas($data, $idKas)
	{
		return $this->db->update('data_transaksi', $data, ['idKas' => $idKas]);
	}

	public function delKas($idKas)
	{
		return $this->db->delete('data_transaksi', ['idKas' => $idKas]);
	}

	public function getKasMasuk()
	{
		return $this->db->get_where('data_transaksi', ['jenis' => 'masuk'])->result();
	}

	public function getKasByIdWarga($idWarga)
	{
		return $this->db->where('jenis', 'masuk')
			->where('idWarga', $idWarga)
			->get('data_transaksi')
			->result();
	}

	public function TotalMasuk()
	{
		return $this->db->query('SELECT SUM(jumlah) as total from data_transaksi where jenis="masuk" ')->result();
	}

	public function getKasKeluar()
	{
		return $this->db->get_where('data_transaksi', ['jenis' => 'keluar'])->result();
	}

	public function TotalKeluar()
	{
		return $this->db->query('SELECT SUM(jumlah) as total from data_transaksi where jenis="keluar" ')->result();
	}

	public function getWarga($idWarga = '', $filter = [])
	{

		$this->db->from('data_warga');

		// Jika pencarian berdasarkan ID Warga (misal untuk detail)
		if (!empty($idWarga)) {
			$this->db->where('idWarga', $idWarga);
			return $this->db->get()->result();
		}

		// Filter berdasarkan parameter pencarian
		if (!empty($filter['nik'])) {
			$this->db->like('nik', $filter['nik']);
		}
		if (!empty($filter['nama'])) {
			$this->db->like('nama', $filter['nama']);
		}
		if (!empty($filter['jekel'])) {
			$this->db->where('jekel', $filter['jekel']);
		}
		if (!empty($filter['tanggal_lahir'])) {
			$this->db->where('tanggal_lahir', $filter['tanggal_lahir']);
		}
		if (!empty($filter['tempat_lahir'])) {
			$this->db->like('tempat_lahir', $filter['tempat_lahir']);
		}
		if (!empty($filter['alamat'])) {
			$this->db->like('alamat', $filter['alamat']);
		}
		if (!empty($filter['rt_rw'])) {
			$this->db->like('rt_rw', $filter['rt_rw']);
		}
		if (!empty($filter['status_perkawinan'])) {
			$this->db->where('status_perkawinan', $filter['status_perkawinan']);
		}

		$this->db->order_by('nama', 'ASC');
		return $this->db->get()->result();
	}

	public function saveWarga($data)
	{
		return $this->db->insert('data_warga', $data);
	}

	public function updateWarga($data, $idWarga)
	{
		return $this->db->update('data_warga', $data, ['idWarga' => $idWarga]);
	}

	public function delWarga($idWarga)
	{
		return $this->db->delete('data_warga', ['idWarga' => $idWarga]);
	}

	public function kredit()
	{
		// Logika untuk mengakses atau memanipulasi data terkait kredit
		// Contoh:
		$this->db->select('*');
		$this->db->from('tabel_kredit');
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file M_kas.php */
