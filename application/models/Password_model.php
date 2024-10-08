<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_user_by_id($id_pengguna)
  {
    $this->db->where('id_pengguna', $id_pengguna);
    return $this->db->get('pengguna')->row();
  }

  public function update_password($id_pengguna, $new_password)
  {
    $this->db->set('password', $new_password);
    $this->db->where('id_pengguna', $id_pengguna);
    return $this->db->update('pengguna');
  }
}
