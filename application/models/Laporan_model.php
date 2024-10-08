<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
  public function get_laporan_hari_ini($id_pengguna)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('DATE(tanggal_masuk)', date('Y-m-d'));
    $query = $this->db->get();
    return $query->result();
  }

  public function get_laporan_bulan_ini($id_pengguna)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('MONTH(tanggal_masuk)', date('m'));
    $this->db->where('YEAR(tanggal_masuk)', date('Y'));
    $query = $this->db->get();
    return $query->result();
  }

  public function get_laporan_tahun_ini($id_pengguna)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('YEAR(tanggal_masuk)', date('Y'));
    $query = $this->db->get();
    return $query->result();
  }

  public function get_all_laporan_bulanan($id_pengguna)
  {
    $this->db->select('MONTH(tanggal_masuk) as bulan, SUM(nominal_masuk) as total');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->group_by('MONTH(tanggal_masuk)');
    $query = $this->db->get();
    return $query->result();
  }

  // Menambahkan metode untuk mendapatkan laporan berdasarkan filter tanggal
  public function get_laporan_hari($id_pengguna, $mulai_tanggal, $sampai_tanggal)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('tanggal_masuk >=', $mulai_tanggal);
    $this->db->where('tanggal_masuk <=', $sampai_tanggal);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_laporan_bulan($id_pengguna, $mulai_tanggal, $sampai_tanggal)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('DATE_FORMAT(tanggal_masuk, "%Y-%m") >=', date('Y-m', strtotime($mulai_tanggal)));
    $this->db->where('DATE_FORMAT(tanggal_masuk, "%Y-%m") <=', date('Y-m', strtotime($sampai_tanggal)));
    $query = $this->db->get();
    return $query->result();
  }

  public function get_laporan_tahun($id_pengguna, $mulai_tanggal, $sampai_tanggal)
  {
    $this->db->select('*');
    $this->db->from('pemasukan');
    $this->db->where('id_pengguna', $id_pengguna);
    $this->db->where('DATE_FORMAT(tanggal_masuk, "%Y") >=', date('Y', strtotime($mulai_tanggal)));
    $this->db->where('DATE_FORMAT(tanggal_masuk, "%Y") <=', date('Y', strtotime($sampai_tanggal)));
    $query = $this->db->get();
    return $query->result();
  }

  public function download()
  {
    // Ambil data laporan dari sesi atau database
    $id_pengguna = $this->session->userdata('id_pengguna');
    $mulai_tanggal = $this->input->post('mulai_tanggal');
    $sampai_tanggal = $this->input->post('sampai_tanggal');

    $laporan = $this->Laporan_model->get_filtered_laporan($id_pengguna, $mulai_tanggal, $sampai_tanggal);

    // Set header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="laporan.csv"');

    // Buka output stream
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Tanggal', 'Deskripsi', 'Nominal']); // Header CSV

    foreach ($laporan as $item) {
      fputcsv($output, [
        $item->tanggal_masuk,
        $item->pemasukan_deskripsi,
        $item->nominal_masuk
      ]);
    }

    fclose($output);
    exit; // Akhiri script setelah pengunduhan
  }

}
