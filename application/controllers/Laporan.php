<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Laporan_model'); // Memuat model Laporan_model
    $this->load->library('session'); // Memuat library session jika diperlukan
  }

  public function index()
  {
    $data['judul'] = 'Laporan';
    $data['laporan'] = []; // Inisialisasi laporan sebagai array kosong
    $data['mulai_tanggal'] = ''; // Inisialisasi variabel tanggal mulai
    $data['sampai_tanggal'] = ''; // Inisialisasi variabel tanggal sampai

    // Menampilkan tampilan laporan
    $this->load->view('template/header', $data);
    $this->load->view('laporan/index', $data);
    $this->load->view('template/footer', $data);
  }

  public function filter()
  {
    // Mendapatkan input dari form
    $mulai_tanggal = $this->input->post('mulai_tanggal');
    $sampai_tanggal = $this->input->post('sampai_tanggal');
    $filter = $this->input->post('filter');

    // Memanggil model untuk mengambil data laporan
    $data['laporan'] = $this->Laporan_model->get_laporan($mulai_tanggal, $sampai_tanggal, $filter);

    // Menyimpan data tanggal ke dalam array untuk ditampilkan
    $data['mulai_tanggal'] = $mulai_tanggal;
    $data['sampai_tanggal'] = $sampai_tanggal;
    $data['judul'] = 'Laporan'; // Judul halaman

    // Menampilkan tampilan laporan dengan data yang difilter
    $this->load->view('laporan/index', $data);
  }

  public function download()
  {
    // Implementasi untuk mendownload laporan (opsional)
    // Anda dapat menambahkan logika di sini untuk mengunduh laporan dalam format yang diinginkan
  }
}
