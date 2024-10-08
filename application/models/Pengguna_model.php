<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Get user data by ID
  public function get_pengguna_by_id($id_pengguna)
  {
    return $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row_array();
  }

  // Update user data
  public function update_pengguna($id_pengguna, $data)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    return $this->db->update('pengguna', $data);
  }
}
