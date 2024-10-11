<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model'); // Memuat model Laporan_model
        $this->load->library('session'); // Memuat library session jika diperlukan
        $this->load->library('tcpdf'); // Memuat library TCPDF
    }

    public function index()
    {
        $data['judul'] = 'Laporan';
    
        // Mendapatkan input dari form (jika ada)
        $mulai_tanggal = $this->input->post('mulai_tanggal') ? $this->input->post('mulai_tanggal') : date('Y-m-01');
        $sampai_tanggal = $this->input->post('sampai_tanggal') ? $this->input->post('sampai_tanggal') : date('Y-m-t');
        $filter = $this->input->post('filter') ? $this->input->post('filter') : 'semua';
    
        // Mendapatkan id_pengguna dari session
        $id_pengguna = $this->session->userdata('id_pengguna');
    
        // Memanggil model untuk mengambil data laporan sesuai filter dan id_pengguna
        $data['laporan'] = $this->Laporan_model->get_laporan($mulai_tanggal, $sampai_tanggal, $filter, $id_pengguna);
    
        // Menyimpan tanggal untuk ditampilkan di view
        $data['mulai_tanggal'] = $mulai_tanggal;
        $data['sampai_tanggal'] = $sampai_tanggal;
        $data['filter'] = $filter;
    
        // Menampilkan tampilan laporan
        $this->load->view('template/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function download_pdf()
    {
        $mulai_tanggal = $this->input->post('mulai_tanggal') ? $this->input->post('mulai_tanggal') : date('Y-m-01');
        $sampai_tanggal = $this->input->post('sampai_tanggal') ? $this->input->post('sampai_tanggal') : date('Y-m-t');
        $filter = $this->input->post('filter') ? $this->input->post('filter') : 'semua';

        // Mendapatkan id_pengguna dari session
        $id_pengguna = $this->session->userdata('id_pengguna');

        // Memanggil model untuk mengambil data laporan
        $data['laporan'] = $this->Laporan_model->get_laporan($mulai_tanggal, $sampai_tanggal, $filter, $id_pengguna);

        // Buat objek PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nama Anda');
        $pdf->SetTitle('Laporan Pemasukkan & Pengeluaran');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('PDF, laporan');

        // Set margin
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Judul
        $html = '<h1>Laporan Pemasukkan & Pengeluaran</h1>';
        $html .= '<p>Menampilkan laporan dari ' . date('d-m-Y', strtotime($mulai_tanggal)) . ' hingga ' . date('d-m-Y', strtotime($sampai_tanggal)) . '</p>';
        
        // Tabel
        $html .= '<table border="1" cellpadding="4">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>';

        $total = 0; // Inisialisasi total
        foreach ($data['laporan'] as $item) {
            // Jika ini adalah pengeluaran, tandai nominal sebagai negatif
            if (isset($item->pengeluaran_deskripsi)) {
                $nominal = -$item->nominal_keluar; // Tampilkan nominal pengeluaran sebagai negatif
            } else {
                $nominal = $item->nominal_masuk; // Nominal pemasukan tetap positif
            }
            $total += $nominal; // Akumulasi total

            $html .= '<tr>
                        <td>' . date('d-m-Y', strtotime($item->tanggal_masuk)) . '</td>
                        <td>' . (isset($item->pengeluaran_deskripsi) ? $item->pengeluaran_deskripsi : $item->pemasukan_deskripsi) . '</td>
                        <td>' . number_format($nominal, 2, ',', '.') . '</td>
                      </tr>';
        }

        $html .= '</tbody>
                  <tfoot>
                      <tr>
                          <td colspan="2"><strong>Total</strong></td>
                          <td><strong>' . number_format($total, 2, ',', '.') . '</strong></td>
                      </tr>
                  </tfoot>
                </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Bersihkan buffer output sebelum mengirim PDF
        ob_clean(); 
        // Output PDF ke browser
        $pdf->Output('laporan_pemasukan_pengeluaran.pdf', 'D'); // 'D' untuk download
    }
}
