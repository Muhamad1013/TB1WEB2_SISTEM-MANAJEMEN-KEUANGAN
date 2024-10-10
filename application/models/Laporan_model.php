<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
  // Mengambil laporan berdasarkan tanggal dan filter
  public function get_laporan($mulai_tanggal, $sampai_tanggal, $filter)
  {
    $this->db->select('tanggal_masuk, deskripsi as pemasukan_deskripsi, nominal_masuk');
    $this->db->from('pemasukan');

    // Menggunakan where untuk filter tanggal
    $this->db->where('tanggal_masuk >=', $mulai_tanggal);
    $this->db->where('tanggal_masuk <=', $sampai_tanggal);

    $query = $this->db->get();
    return $query->result(); // Mengembalikan hasil sebagai array objek
  }

  // Jika ada laporan pengeluaran, dapat dibuat fungsi terpisah untuk itu
}
