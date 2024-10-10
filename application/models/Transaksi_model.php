<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Fungsi untuk menyimpan transaksi baru
  public function simpan_transaksi($data)
  {
    return $this->db->insert('transaksi', $data);
  }

  // Fungsi untuk menyimpan kategori baru
  public function simpan_kategori($data)
  {
    return $this->db->insert('kategori', $data);
  }

  public function insert_transaksi($data)
  {
    return $this->db->insert('transaksi', $data);
  }

  // Fungsi untuk menampilkan semua kategori milik pengguna
  public function get_all_kategori($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    $query = $this->db->get('kategori');
    return $query->result();
  }

  // Fungsi untuk mengambil semua transaksi milik pengguna
  public function get_all_transaksi($id_pengguna)
  {
    $this->db->select('id_transaksi, nominal_keluar AS nominal, tanggal_transaksi AS tanggal, deskripsi, tipe_transaksi AS tipe');
    $this->db->where('id_pengguna', $id_pengguna);
    $query = $this->db->get('transaksi');
    return $query->result();
  }

  public function insert($data)
  {
    // Menyimpan data ke tabel pemasukan
    $this->db->insert('transaksi', array(
      'id_pengguna' => $data['id_pengguna'],
      'nominal_keluar' => $data['nominal'],
      'tanggal_transaksi' => $data['tanggal'],
      'deskripsi' => $data['deskripsi']
    ));
  }

  public function insert_pemasukan($data)
  {
    // Menyimpan data ke tabel pemasukan
    $this->db->insert('pemasukan', array(
      'id_pengguna' => $data['id_pengguna'],
      'nominal_masuk' => isset($data['nominal_masuk']) ? $data['nominal_masuk'] : 0,
      'tanggal_masuk' => isset($data['tanggal_masuk']) ? $data['tanggal_masuk'] : date('Y-m-d'),
      'deskripsi' => isset($data['deskripsi']) ? $data['deskripsi'] : ''
    ));
  }

  public function insert_pengeluaran($data)
  {
    // Menyimpan data ke tabel pengeluaran
    $this->db->insert('pengeluaran', array(
      'id_pengguna' => $data['id_pengguna'],
      'nominal_keluar' => isset($data['nominal_keluar']) ? $data['nominal_keluar'] : 0,
      'tanggal_keluar' => isset($data['tanggal_transaksi']) ? $data['tanggal_transaksi'] : date('Y-m-d'),
      'deskripsi' => isset($data['deskripsi']) ? $data['deskripsi'] : ''
    ));
  }

  // Fungsi untuk mengambil transaksi berdasarkan waktu dan jenis
  public function get_transaksi($id_pengguna, $time_filter = null, $type_filter = null)
  {
    $this->db->where('id_pengguna', $id_pengguna);

    // Filtering berdasarkan waktu
    if ($time_filter == 'daily') {
      $this->db->where('DATE(tanggal_transaksi)', date('Y-m-d'));
    } elseif ($time_filter == 'monthly') {
      $this->db->where('MONTH(tanggal_transaksi)', date('m'));
      $this->db->where('YEAR(tanggal_transaksi)', date('Y'));
    } elseif ($time_filter == 'yearly') {
      $this->db->where('YEAR(tanggal_transaksi)', date('Y'));
    }

    // Filtering berdasarkan jenis
    if ($type_filter == 'income') {
      $this->db->where('tipe_transaksi', 'income');
    } elseif ($type_filter == 'expense') {
      $this->db->where('tipe_transaksi', 'expense');
    }

    $query = $this->db->get('transaksi');
    return $query->result();
  }

  public function hapus_transaksi($id_transaksi, $id_pengguna)
  {
    // Ambil transaksi untuk menentukan tipe
    $transaksi = $this->get_transaksi_by_id($id_transaksi, $id_pengguna);

    if ($transaksi) {
      // Hapus dari tabel transaksi
      $this->db->where('id_transaksi', $id_transaksi);
      $this->db->delete('transaksi');

      // Hapus dari tabel pemasukan atau pengeluaran sesuai tipe
      if ($transaksi->tipe === 'income') {
        $this->hapus_pemasukan($id_transaksi);
      } elseif ($transaksi->tipe === 'expense') {
        $this->hapus_pengeluaran($id_transaksi);
      }

      return true;
    }
    return false;
  }

  public function hapus_pemasukan($id_transaksi)
  {
    // Menghapus dari tabel pemasukan
    $this->db->where('id_pengguna', $this->session->userdata('id_pengguna'));
    $this->db->where('nominal_masuk', $this->get_nominal_from_transaksi($id_transaksi));
    return $this->db->delete('pemasukan');
  }

  public function hapus_pengeluaran($id_transaksi)
  {
    // Menghapus dari tabel pengeluaran
    $this->db->where('id_pengguna', $this->session->userdata('id_pengguna'));
    $this->db->where('nominal_keluar', $this->get_nominal_from_transaksi($id_transaksi));
    return $this->db->delete('pengeluaran');
  }

  // Ambil nominal dari transaksi berdasarkan id_transaksi
  public function get_nominal_from_transaksi($id_transaksi)
  {
    $this->db->select('nominal_keluar');
    $this->db->where('id_transaksi', $id_transaksi);
    $query = $this->db->get('transaksi');
    return $query->row()->nominal_keluar ?? 0; // Kembalikan nominal_keluar atau 0 jika tidak ada
  }

  // Ambil transaksi berdasarkan id
  public function get_transaksi_by_id($id_transaksi, $id_pengguna)
  {
    $this->db->where('id_transaksi', $id_transaksi);
    $this->db->where('id_pengguna', $id_pengguna);
    return $this->db->get('transaksi')->row(); // Kembalikan baris transaksi
  }
}
