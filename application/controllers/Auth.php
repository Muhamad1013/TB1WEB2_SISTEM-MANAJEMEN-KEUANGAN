<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Proses login
        if ($this->input->post('email') && $this->input->post('password')) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('pengguna', ['email' => $email])->row();

            // Cek apakah pengguna ada dan password cocok (tanpa hashing)
            if ($user && $user->password == $password) {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('id_pengguna', $user->id_pengguna);
                $this->session->set_userdata('nama_pengguna', $user->nama_pengguna);
                $this->session->set_userdata('user_image', $user->image); // Menyimpan path gambar user dari database

                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('auth');
            }
        }

        $data['registration_success'] = $this->session->flashdata('registration_success');
        $data['judul'] = 'Login Page';

        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('template/auth_footer', $data);
    }

    public function registration()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Proses registrasi
        if ($this->input->post('nama_pengguna') && $this->input->post('email') && $this->input->post('password1')) {
            $nama_pengguna = $this->input->post('nama_pengguna');
            $email = $this->input->post('email');
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');

            if ($password1 !== $password2) {
                $this->session->set_flashdata('error', 'Password tidak cocok');
                redirect('auth/registration');
            }

            $data = [
                'nama_pengguna' => $nama_pengguna,
                'email' => $email,
                'password' => $password1, 
                'gambar' => 'path/to/default/image.png', 
                'tanggal_dibuat' => date('Y-m-d H:i:s'),
            ];

            // Cek apakah email sudah terdaftar
            if ($this->db->get_where('pengguna', ['email' => $email])->num_rows() == 0) {
                $this->db->insert('pengguna', $data);
                $this->session->set_flashdata('registration_success', 'Registration berhasil!');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Email sudah terdaftar');
                redirect('auth/registration');
            }
        }

        $data['judul'] = 'Registration Page';

        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/registration', $data);
        $this->load->view('template/auth_footer', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
