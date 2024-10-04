<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $id_pengguna = $this->session->userdata('id_pengguna');

        $data['judul'] = 'Dashboard';
        $data['nama'] = $this->session->userdata('nama_pengguna');
        $data['pemasukan_hari_ini'] = $this->Keuangan_model->get_pemasukan_hari_ini($id_pengguna);
        $data['pengeluaran_hari_ini'] = $this->Keuangan_model->get_pengeluaran_hari_ini($id_pengguna);
        $data['pemasukan_bulan_ini'] = $this->Keuangan_model->get_pemasukan_bulan_ini($id_pengguna);
        $data['pengeluaran_bulan_ini'] = $this->Keuangan_model->get_pengeluaran_bulan_ini($id_pengguna);
        $data['pemasukan_tahun_ini'] = $this->Keuangan_model->get_pemasukan_tahun_ini($id_pengguna);
        $data['pengeluaran_tahun_ini'] = $this->Keuangan_model->get_pengeluaran_tahun_ini($id_pengguna);
        $data['seluruh_pemasukan'] = $this->Keuangan_model->get_seluruh_pemasukan($id_pengguna);
        $data['seluruh_pengeluaran'] = $this->Keuangan_model->get_seluruh_pengeluaran($id_pengguna);

        // Ambil data bulanan untuk grafik
        $data['pemasukan_bulanan'] = $this->Keuangan_model->get_all_pemasukan_bulanan($id_pengguna);
        $data['pengeluaran_bulanan'] = $this->Keuangan_model->get_all_pengeluaran_bulanan($id_pengguna);

        // Load view dengan data
        $this->load->view('template/header', $data);
        $this->load->view('home/dashboard', $data);
        $this->load->view('template/footer', $data);
    }
}