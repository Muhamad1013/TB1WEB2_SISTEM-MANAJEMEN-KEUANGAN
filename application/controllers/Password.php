<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Password_model');
    $this->load->library('session');
  }

  public function index()
  {
    $data['judul'] = 'Change Password';
    $this->load->view('template/header', $data);
    $this->load->view('password/index', $data);
    $this->load->view('template/footer');
  }

  public function update_password()
  {
    $old_password = $this->input->post('oldPassword');
    $new_password = $this->input->post('newPassword');
    $confirm_password = $this->input->post('confirmPassword');
    $id_pengguna = $this->session->userdata('id_pengguna');

    $user = $this->Password_model->get_user_by_id($id_pengguna);

    if ($user && $user->password === $old_password) {
      if ($new_password === $confirm_password) {
        $this->Password_model->update_password($id_pengguna, $new_password);
        $this->session->set_flashdata('message', 'Password berhasil diubah');
      } else {
        $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok');
      }
    } else {
      $this->session->set_flashdata('error', 'Password lama salah');
    }

    redirect('password');
  }
}
