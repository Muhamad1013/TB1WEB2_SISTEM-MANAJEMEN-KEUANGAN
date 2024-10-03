<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data['judul'] = 'Data Kategori';
        $data['pemasukan_hari_ini'] = $this->Kategori_model->get_coba();

        // Load view dengan data
        $this->load->view('template/header', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('template/footer', );
    }
}
