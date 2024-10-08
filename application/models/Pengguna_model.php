<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
    // Mengambil data pengguna berdasarkan ID
    public function get_pengguna_by_id($id)
    {
        return $this->db->get_where('pengguna', ['id_pengguna' => $id])->row_array();
    }

    // Memperbarui data pengguna
    public function update_pengguna($id, $data)
    {
        $this->db->where('id_pengguna', $id);
        return $this->db->update('pengguna', $data);
    }

    // Mengambil gambar pengguna berdasarkan ID
    public function get_gambar_by_id($id)
    {
        $this->db->select('gambar');
        $this->db->from('pengguna');
        $this->db->where('id_pengguna', $id);
        $query = $this->db->get();
        return $query->row()->gambar; // Mengembalikan nama file gambar
    }
}
