<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengguna_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        // Ambil id_pengguna dari session
        $id_pengguna = $this->session->userdata('id_pengguna');
        $data['judul'] = 'Data Pengguna';

        // Pastikan id_pengguna tersedia
        if (!$id_pengguna) {
            redirect('login'); // Ganti dengan route login Anda
        }

        // Ambil data pengguna berdasarkan ID
        $data['pengguna'] = $this->Pengguna_model->get_pengguna_by_id($id_pengguna);

        // Ambil gambar dan nama pengguna
        $data['user_images'] = $data['pengguna']['user_images'] ?? 'default.png'; // Gambar pengguna
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'] ?? 'User'; // Nama pengguna

        // Set aturan validasi form
        $this->form_validation->set_rules('nama_pengguna', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            // Load view edit
            $this->load->view('template/header', $data);
            $this->load->view('pengguna/index', $data);
            $this->load->view('template/footer');
        } else {
            // Siapkan data untuk update
            $update_data = [
                'nama_pengguna' => $this->input->post('nama_pengguna'),
                'email' => $this->input->post('email')
            ];

            // Cek apakah ada file gambar yang diupload
            if (!empty($_FILES['gambar']['name'])) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Maksimal 2MB
                $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')) {
                    // Jika gambar berhasil diupload
                    $upload_data = $this->upload->data();
                    $update_data['gambar'] = $upload_data['file_name']; // Simpan nama file gambar

                    // Update session dengan gambar baru
                    $this->session->set_userdata('gambar', $upload_data['file_name']);
                } else {
                    // Jika gagal upload, tampilkan pesan error
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    redirect('pengguna'); // Redirect kembali
                }
            }

            // Update data pengguna di database
            if ($this->Pengguna_model->update_pengguna($id_pengguna, $update_data)) {
                // Set flash message dan redirect
                $this->session->set_flashdata('message', 'Profil berhasil diperbarui!');

                // Menyimpan data ke session
                $this->session->set_userdata('nama_pengguna', $update_data['nama_pengguna']);

                redirect('pengguna'); // Redirect ke index
            } else {
                $this->session->set_flashdata('message', 'Gagal memperbarui profil!');
                redirect('pengguna'); // Redirect kembali
            }
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
