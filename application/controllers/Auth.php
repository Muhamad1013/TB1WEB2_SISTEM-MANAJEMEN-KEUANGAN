<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengguna_model'); // Pastikan model pengguna sudah di-load
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Proses login
        if ($this->input->post('email') && $this->input->post('password')) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Ambil data pengguna dari database berdasarkan email
            $user = $this->db->get_where('pengguna', ['email' => $email])->row();

            // Cek apakah pengguna ada dan password cocok (pastikan untuk menggunakan password hashing)
            if ($user && $user->password == $password) {
                // Simpan data pengguna di session
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('id_pengguna', $user->id_pengguna);
                $this->session->set_userdata('nama_pengguna', $user->nama_pengguna);
                // Simpan gambar pengguna, gunakan gambar default jika tidak ada
                $this->session->set_userdata('gambar', $user->gambar ?? 'default.png');

                // Redirect ke dashboard
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah');
                redirect('auth');
            }
        }

        // Data untuk halaman login
        $data['registration_success'] = $this->session->flashdata('registration_success');
        $data['judul'] = 'Login Page';

        // Load view login
        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('template/auth_footer', $data);
    }

    public function registration()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Proses registrasi
        if ($this->input->post('nama_pengguna') && $this->input->post('email') && $this->input->post('password1')) {
            $nama_pengguna = $this->input->post('nama_pengguna');
            $email = $this->input->post('email');
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');

            // Cek apakah password cocok
            if ($password1 !== $password2) {
                $this->session->set_flashdata('error', 'Password tidak cocok');
                redirect('auth/registration');
            }

            // Data untuk dimasukkan ke database
            $data = [
                'nama_pengguna' => $nama_pengguna,
                'email' => $email,
                'password' => $password1, // Pastikan ini di-hash untuk keamanan
                'gambar' => 'default.png', // Set gambar default
                'tanggal_dibuat' => date('Y-m-d H:i:s'),
            ];

            // Cek apakah email sudah terdaftar
            if ($this->db->get_where('pengguna', ['email' => $email])->num_rows() == 0) {
                // Simpan data pengguna baru
                $this->db->insert('pengguna', $data);
                $this->session->set_flashdata('registration_success', 'Registrasi berhasil!');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Email sudah terdaftar');
                redirect('auth/registration');
            }
        }

        $data['judul'] = 'Registration Page';

        // Load view registrasi
        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/registration', $data);
        $this->load->view('template/auth_footer', $data);
    }

    public function logout()
    {
        // Hapus semua session data saat logout
        $this->session->sess_destroy();
        redirect('auth');
    }
}
