<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database(); // Memuat database
  }

  // Mengambil data pengguna berdasarkan ID
  public function get_user_by_id($id_pengguna)
  {
    // Mengambil data pengguna dari tabel `pengguna` berdasarkan `id_pengguna`
    $this->db->where('id_pengguna', $id_pengguna);
    return $this->db->get('pengguna')->row(); // Mengembalikan satu baris hasil query
  }

  // Update password pengguna di database
  public function update_password($id_pengguna, $new_password)
  {
    // Update password pada field `password` di tabel `pengguna`
    $this->db->set('password', $new_password); // Mengatur password baru
    $this->db->where('id_pengguna', $id_pengguna); // Mencari pengguna berdasarkan `id_pengguna`
    return $this->db->update('pengguna'); // Melakukan update di tabel pengguna
  }
}
