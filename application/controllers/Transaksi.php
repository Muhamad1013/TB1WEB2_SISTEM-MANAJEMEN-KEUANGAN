<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $id_pengguna = $this->session->userdata('id_pengguna');
        $data['judul'] = 'Data Transaksi';

        // Ambil data kategori untuk tampilan awal
        $data['kategori'] = $this->Transaksi_model->get_all_kategori($id_pengguna);

        // Load view dengan data
        $this->load->view('template/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('template/footer');
    }

    public function filter()
    {
        $filter = $this->input->post('filter');
        $id_pengguna = $this->session->userdata('id_pengguna');

        // Filter berdasarkan waktu (harian, bulanan, tahunan)
        if ($filter == 'daily') {
            $data['kategori'] = $this->Transaksi_model->get_Transaksi_per_hari($id_pengguna);
        } elseif ($filter == 'monthly') {
            $data['kategori'] = $this->Transaksi_model->get_kategori_per_bulan($id_pengguna);
        } elseif ($filter == 'yearly') {
            $data['kategori'] = $this->Transaksi_model->get_kategori_per_tahun($id_pengguna);
        } else {
            $data['kategori'] = $this->Transaksi_model->get_all_kategori($id_pengguna);
        }

        // Mengembalikan tabel kategori yang sudah difilter untuk Ajax
        $this->load->view('transaksi/table', $data);
    }
}
