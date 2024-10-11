<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    // Mengambil laporan berdasarkan tanggal, filter, dan id_pengguna
    public function get_laporan($mulai_tanggal, $sampai_tanggal, $filter, $id_pengguna)
    {
        // Ambil pemasukan sesuai dengan id_pengguna
        $this->db->select('tanggal_masuk, deskripsi as pemasukan_deskripsi, nominal_masuk');
        $this->db->from('pemasukan');
        $this->db->where('tanggal_masuk >=', $mulai_tanggal);
        $this->db->where('tanggal_masuk <=', $sampai_tanggal);
        $this->db->where('id_pengguna', $id_pengguna); // Tambahkan kondisi berdasarkan id_pengguna
        
        $query = $this->db->get();
        $pemasukan = $query->result(); // Mengembalikan hasil sebagai array objek

        // Ambil pengeluaran sesuai dengan id_pengguna
        $this->db->select('tanggal_keluar as tanggal_masuk, deskripsi as pengeluaran_deskripsi, nominal_keluar');
        $this->db->from('pengeluaran');
        $this->db->where('tanggal_keluar >=', $mulai_tanggal);
        $this->db->where('tanggal_keluar <=', $sampai_tanggal);
        $this->db->where('id_pengguna', $id_pengguna); // Tambahkan kondisi berdasarkan id_pengguna
        
        $query = $this->db->get();
        $pengeluaran = $query->result(); // Mengembalikan hasil sebagai array objek

        // Gabungkan pemasukan dan pengeluaran
        $laporan = array_merge($pemasukan, $pengeluaran);
        
        return $laporan; // Mengembalikan hasil gabungan
    }
}
