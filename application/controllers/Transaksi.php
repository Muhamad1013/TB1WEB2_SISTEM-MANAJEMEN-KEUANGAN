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

        // Ambil data transaksi untuk ditampilkan (default)
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi($id_pengguna);

        // Load view dengan data
        $this->load->view('template/header', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('template/footer', );
    }

    public function filter()
    {
        $type = $this->input->post('type');
        $time = $this->input->post('time');
        $id_pengguna = $this->session->userdata('id_pengguna');

        // Ambil transaksi berdasarkan waktu dan jenis
        $data['transaksi'] = $this->Transaksi_model->get_transaksi($id_pengguna, $time, $type);

        // Mengembalikan tabel transaksi yang sudah difilter untuk Ajax
        $this->load->view('transaksi/table', $data);
    }

    public function simpan_transaksi()
    {
        $nominal = $this->input->post('nominal_keluar'); // Periksa nama input Anda
        $tanggal = $this->input->post('tanggal_transaksi');
        $deskripsi = $this->input->post('deskripsi');
        $tipe_transaksi = $this->input->post('tipe_transaksi');
        $id_pengguna = $this->session->userdata('id_pengguna'); // Ambil id_pengguna dari session


        if ($tipe_transaksi === 'income') {
            $data_pemasukan = array(
                'id_pengguna' => $id_pengguna,
                'nominal_masuk' => isset($nominal) ? $nominal : 0, // Pastikan nominal_keluar tidak NULL
                'tanggal_masuk' => isset($tanggal) ? $tanggal : date('Y-m-d'),  // Pastikan tanggal_transaksi tidak NULL
                'deskripsi' => isset($deskripsi) ? $deskripsi : ''
            );
            // Simpan ke tabel pemasukan
            $this->Transaksi_model->insert_pemasukan($data_pemasukan);

        } elseif ($tipe_transaksi === 'expense') {
            $data_pengeluaran = array(
                'id_pengguna' => $id_pengguna,
                'nominal_keluar' => isset($nominal) ? $nominal : 0, // Pastikan nominal_keluar tidak NULL
                'tanggal_keluar' => isset($tanggal) ? $tanggal : date('Y-m-d'),  // Pastikan tanggal_transaksi tidak NULL
                'deskripsi' => isset($deskripsi) ? $deskripsi : ''
            );
            // Simpan ke tabel pengeluaran
            $this->Transaksi_model->insert_pengeluaran($data_pengeluaran);
        }
        // Persiapkan data untuk disimpan
        $data_transaksi = array(
            'id_pengguna' => $id_pengguna,
            'nominal_keluar' => $nominal, // Pastikan ini sesuai dengan nama kolom di tabel
            'tanggal_transaksi' => $tanggal,
            'deskripsi' => $deskripsi,
            'tipe_transaksi' => $tipe_transaksi
        );
        $this->Transaksi_model->insert_transaksi($data_transaksi);

        // Flashdata untuk pesan sukses
        $this->session->set_flashdata('success', 'Transaksi berhasil disimpan.');
        redirect('transaksi/index'); // Redirect ke halaman transaksi
    }

    public function tambah_transaksi()
    {
        $tipe_transaksi = $this->input->post('tipe_transaksi');

        $data = [
            'id_pengguna' => $this->session->userdata('id_pengguna'),
            'nominal_keluar' => $this->input->post('nominal_keluar'),
            'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tipe_transaksi' => $tipe_transaksi('tipe_transaksi')
        ];

        if ($this->Transaksi_model->simpan_transaksi($data)) {
            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Transaksi gagal ditambahkan.');
        }

        redirect('transaksi');
    }

    public function update_transaksi()
    {
        // Ambil data dari form
        $id_transaksi = $this->input->post('id_transaksi');
        $nominal = $this->input->post('nominal_keluar');
        $tanggal = $this->input->post('tanggal_transaksi');
        $deskripsi = $this->input->post('deskripsi');
        $tipe_transaksi = $this->input->post('tipe_transaksi');
        $id_pengguna = $this->session->userdata('id_pengguna');

        $data_transaksi = array(
            'nominal_keluar' => $nominal,
            'tanggal_transaksi' => $tanggal,
            'deskripsi' => $deskripsi,
            'tipe_transaksi' => $tipe_transaksi
        );

        // Update data transaksi
        $this->Transaksi_model->update_transaksi($id_transaksi, $data_transaksi);

        $this->session->set_flashdata('success', 'Transaksi berhasil diperbarui.');
        redirect('transaksi/index');
    }

    public function hapus($id_transaksi)
    {
        $id_pengguna = $this->session->userdata('id_pengguna');

        // Ambil tipe transaksi sebelum menghapus
        $transaksi = $this->Transaksi_model->get_transaksi_by_id($id_transaksi, $id_pengguna);

        if ($transaksi) {
            // Hapus dari tabel pemasukan atau pengeluaran
            if ($transaksi->tipe_transaksi === 'income') {
                $this->Transaksi_model->hapus_pemasukan($id_transaksi);
            } elseif ($transaksi->tipe_transaksi === 'expense') {
                $this->Transaksi_model->hapus_pengeluaran($id_transaksi);
            }

            // Hapus dari tabel transaksi
            $this->Transaksi_model->hapus_transaksi($id_transaksi, $id_pengguna);
            $this->session->set_flashdata('success', 'Transaksi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan.');
        }

        redirect('transaksi/index'); // Redirect ke halaman transaksi
    }




}
