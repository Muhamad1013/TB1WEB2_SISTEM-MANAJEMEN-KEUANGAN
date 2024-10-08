<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Laporan_model');

    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }
  }

  public function index()
  {
    $id_pengguna = $this->session->userdata('id_pengguna');

    $data['judul'] = 'Laporan Keuangan';
    $data['nama'] = $this->session->userdata('nama_pengguna');

    // Ambil data laporan untuk hari ini, bulan ini, dan tahun ini
    $data['laporan_hari_ini'] = $this->Laporan_model->get_laporan_hari_ini($id_pengguna);
    $data['laporan_bulan_ini'] = $this->Laporan_model->get_laporan_bulan_ini($id_pengguna);
    $data['laporan_tahun_ini'] = $this->Laporan_model->get_laporan_tahun_ini($id_pengguna);

    // Ambil data bulanan untuk grafik
    $data['laporan_bulanan'] = $this->Laporan_model->get_all_laporan_bulanan($id_pengguna);

    // Load view dengan data
    $this->load->view('template/header', $data);
    $this->load->view('laporan/index', $data);
    $this->load->view('template/footer', $data);
  }

  public function filter()
  {
    $id_pengguna = $this->session->userdata('id_pengguna');
    $mulai_tanggal = $this->input->post('mulai_tanggal');
    $sampai_tanggal = $this->input->post('sampai_tanggal');
    $filter = $this->input->post('filter'); // Menangkap pilihan filter

    $data['judul'] = 'Laporan Keuangan';
    $data['nama'] = $this->session->userdata('nama_pengguna');

    // Ambil laporan berdasarkan filter yang dipilih
    if ($filter === 'hari') {
      $data['laporan'] = $this->Laporan_model->get_filtered_laporan($id_pengguna, $mulai_tanggal, $sampai_tanggal);
    } elseif ($filter === 'bulan') {
      $data['laporan'] = $this->Laporan_model->get_laporan_bulan_ini($id_pengguna); // Atur sesuai kebutuhan
    } elseif ($filter === 'tahun') {
      $data['laporan'] = $this->Laporan_model->get_laporan_tahun_ini($id_pengguna); // Atur sesuai kebutuhan
    }

    // Load view dengan data laporan yang telah difilter
    $this->load->view('template/header', $data);
    $this->load->view('laporan/index', $data);
    $this->load->view('template/footer', $data);
  }

}
