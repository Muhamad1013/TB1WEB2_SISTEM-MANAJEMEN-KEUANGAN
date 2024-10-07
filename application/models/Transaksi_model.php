<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Fungsi untuk menampilkan semua kategori milik pengguna
  public function get_all_kategori($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    $query = $this->db->get('kategori');  // Asumsi tabel bernama 'kategori'
    return $query->result();
  }

  // Fungsi untuk mengambil kategori berdasarkan hari iniW
  public function get_kategori_per_hari($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('DATE(tanggal)', date('Y-m-d'));
    $query = $this->db->get('kategori');  // Asumsi tabel bernama 'kategori'
    return $query->result();
  }

  // Fungsi untuk mengambil kategori berdasarkan bulan ini
  public function get_kategori_per_bulan($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('MONTH(tanggal)', date('m'));
    $this->db->where('YEAR(tanggal)', date('Y'));
    $query = $this->db->get('kategori');  // Asumsi tabel bernama 'kategori'
    return $query->result();
  }

  // Fungsi untuk mengambil kategori berdasarkan tahun ini
  public function get_kategori_per_tahun($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('YEAR(tanggal)', date('Y'));
    $query = $this->db->get('kategori');  // Asumsi tabel bernama 'kategori'
    return $query->result();
  }
}
