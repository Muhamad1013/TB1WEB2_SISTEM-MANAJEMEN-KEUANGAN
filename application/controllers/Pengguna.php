<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengguna_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    // Ambil id_pengguna dari session
    $id_pengguna = $this->session->userdata('id_pengguna');

    // Pastikan id_pengguna tersedia
    if (!$id_pengguna) {
      // Redirect atau tampilkan pesan error jika id_pengguna tidak ada
      redirect('login'); // Ganti dengan route login Anda
    }

    // Ambil data pengguna berdasarkan ID
    $data['pengguna'] = $this->Pengguna_model->get_pengguna_by_id($id_pengguna);

    // Set aturan validasi form
    $this->form_validation->set_rules('nama_pengguna', 'Username', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

    if ($this->form_validation->run() == false) {
      // Load view edit
      $this->load->view('template/header');
      $this->load->view('pengguna/index', $data);
      $this->load->view('template/footer');
    } else {
      // Update data pengguna
      $update_data = [
        'nama_pengguna' => $this->input->post('nama_pengguna'),
        'email' => $this->input->post('email')
      ];

      $this->Pengguna_model->update_pengguna($id_pengguna, $update_data);
      $this->session->set_flashdata('message', 'Profil berhasil diperbarui!');
      redirect('pengguna/index'); // Redirect ke index
    }
  }

  public function change_password()
  {
    // Ambil id_pengguna dari session
    $id_pengguna = $this->session->userdata('id_pengguna');

    // Pastikan id_pengguna tersedia
    if (!$id_pengguna) {
      redirect('login'); // Ganti dengan route login Anda
    }

    // Redirect ke form ganti password
    redirect('password/change/' . $id_pengguna);
  }
}
