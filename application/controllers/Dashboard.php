<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['pemasukan_hari_ini'] = $this->Keuangan_model->get_pemasukan_hari_ini();
        $data['pengeluaran_hari_ini'] = $this->Keuangan_model->get_pengeluaran_hari_ini();
        $data['pemasukan_bulan_ini'] = $this->Keuangan_model->get_pemasukan_bulan_ini();
        $data['pengeluaran_bulan_ini'] = $this->Keuangan_model->get_pengeluaran_bulan_ini();
        $data['pemasukan_tahun_ini'] = $this->Keuangan_model->get_pemasukan_tahun_ini();
        $data['pengeluaran_tahun_ini'] = $this->Keuangan_model->get_pengeluaran_tahun_ini();
        $data['seluruh_pemasukan'] = $this->Keuangan_model->get_seluruh_pemasukan(); 
        $data['seluruh_pengeluaran'] = $this->Keuangan_model->get_seluruh_pengeluaran();

        // Ambil data bulanan untuk grafik
        $data['pemasukan_bulanan'] = $this->Keuangan_model->get_all_pemasukan_bulanan(); 
        $data['pengeluaran_bulanan'] = $this->Keuangan_model->get_all_pengeluaran_bulanan();

        // Load view dengan data
        $this->load->view('template/header', $data);
        $this->load->view('home/dashboard', $data);
        $this->load->view('template/footer', );
    }
}
