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

	public function getSampah($idKas = '')
	{
		if ($idKas) {
			return $this->db->get('data_transaksi', ['idKas' => $idKas, 'status' => 'kas'])->row_array();
		} else {
			return $this->db->where('status', 'sampah')->get('data_transaksi')->result();
		}
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

	public function getWarga($idWarga = '')
	{
		if ($idWarga) {
			return $this->db->get('data_warga', ['idWarga' => $idWarga])->row_array();
		} else {
			return $this->db->order_by('nama', 'ASC')->get('data_warga')->result();
		}
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
