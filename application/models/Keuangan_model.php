<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Keuangan_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_pemasukan_hari_ini()
  {
    $this->db->select_sum('nominal_masuk');
    $this->db->where('tanggal_masuk', date('Y-m-d'));
    $query = $this->db->get('pemasukan');
    return $query->row()->nominal_masuk ?: 0; 
  }

  public function get_pengeluaran_hari_ini()
  {
    $this->db->select_sum('nominal_keluar');
    $this->db->where('tanggal_keluar', date('Y-m-d'));
    $query = $this->db->get('pengeluaran');
    return $query->row()->nominal_keluar ?: 0; 
  }

  public function get_pemasukan_bulan_ini()
  {
    $this->db->select_sum('nominal_masuk');
    $this->db->where('MONTH(tanggal_masuk)', date('m'));
    $query = $this->db->get('pemasukan');
    return $query->row()->nominal_masuk ?: 0; 
  }

  public function get_pengeluaran_bulan_ini()
  {
    $this->db->select_sum('nominal_keluar');
    $this->db->where('MONTH(tanggal_keluar)', date('m'));
    $query = $this->db->get('pengeluaran');
    return $query->row()->nominal_keluar ?: 0;
  }


  public function get_pemasukan_tahun_ini()
  {
    $this->db->select_sum('nominal_masuk');
    $this->db->where('YEAR(tanggal_masuk)', date('Y'));
    $query = $this->db->get('pemasukan');
    return $query->row()->nominal_masuk ?: 0;
  }

  public function get_pengeluaran_tahun_ini()
  {
    $this->db->select_sum('nominal_keluar');
    $this->db->where('YEAR(tanggal_keluar)', date('Y'));
    $query = $this->db->get('pengeluaran');
    return $query->row()->nominal_keluar ?: 0;
  }

  public function get_all_pemasukan_bulanan()
  {
    $result = [];
    for ($i = 1; $i <= 12; $i++) {
      $this->db->select_sum('nominal_masuk');
      $this->db->where('MONTH(tanggal_masuk)', $i);
      $this->db->where('YEAR(tanggal_masuk)', date('Y'));
      $query = $this->db->get('pemasukan');

      $result[] = $query->row()->nominal_masuk ?: 0;
    }
    return $result;
  }

  public function get_all_pengeluaran_bulanan()
  {
    $result = [];
    for ($i = 1; $i <= 12; $i++) {
      $this->db->select_sum('nominal_keluar');
      $this->db->where('MONTH(tanggal_keluar)', $i);
      $this->db->where('YEAR(tanggal_keluar)', date('Y'));
      $query = $this->db->get('pengeluaran');

      $result[] = $query->row()->nominal_keluar ?: 0;
    }
    return $result;
  }

  public function get_seluruh_pemasukan()
  {
    $this->db->select_sum('nominal_masuk');
    $query = $this->db->get('pemasukan');

    
    return $query->row()->nominal_masuk ?: 0;
  }

  public function get_seluruh_pengeluaran()
  {
    $this->db->select_sum('nominal_keluar'); 
    $query = $this->db->get('pengeluaran'); 
    return $query->row()->nominal_keluar ?: 0; 
  }


}