<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Password_model'); // Pastikan model sudah di-load
    $this->load->library('session'); // Pastikan library session sudah di-load
  }

  public function index()
  {
    $data['judul'] = 'Change Password';
    // Tampilkan halaman change password dengan pesan dari flashdata
    $this->load->view('template/header', $data);
    $this->load->view('password/index', $data); // View untuk form ganti password
    $this->load->view('template/footer');
  }

  public function update_password()
  {
    $old_password = $this->input->post('oldPassword');
    $new_password = $this->input->post('newPassword');
    $confirm_password = $this->input->post('confirmPassword');
    $id_pengguna = $this->session->userdata('id_pengguna'); // Ambil ID pengguna dari session

    // Ambil data pengguna
    $user = $this->Password_model->get_user_by_id($id_pengguna);

    // Pastikan pengguna ada dan password lama sesuai
    if ($user && $user->password === $old_password) {
      // Pastikan password baru dan konfirmasi sama
      if ($new_password === $confirm_password) {
        // Update password di database
        $this->Password_model->update_password($id_pengguna, $new_password);
        $this->session->set_flashdata('message', 'Password berhasil diubah');
      } else {
        $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok');
      }
    } else {
      $this->session->set_flashdata('error', 'Password lama salah');
    }

    // Redirect ke halaman password
    redirect('password');
  }
}
