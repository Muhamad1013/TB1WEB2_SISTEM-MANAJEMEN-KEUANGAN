<div class="content" id="content">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="mb-0"><?= $judul ?></h3>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo site_url('laporan'); ?>" method="post">
                <div class="filter-laporan-box">
                    <h4>Filter Laporan</h4>
                    <div class="flex-laporan">
                        <label for="mulai_tanggal">Mulai Tanggal <input type="date" id="mulai_tanggal" name="mulai_tanggal" required></label>
                        <label for="sampai_tanggal">Sampai Tanggal <input type="date" id="sampai_tanggal" name="sampai_tanggal" required></label>
                        <label for="filter">Filter 
                            <select name="filter" id="filter">
                                <option value="semua">- Semua Kategori -</option>
                                <option value="hari">Per Hari</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </label>
                        <button type="submit">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Filter Laporan -->
    <div class="row">
        <div class="col-md-12">
            <h4>Laporan Pemasukkan & Pengeluaran</h4>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($laporan) && !empty($laporan)): ?>
                <div class="d-flex justify-content-between mb-3">
                    <span>Menampilkan laporan dari <?php echo date('d-m-Y', strtotime($mulai_tanggal)); ?> hingga <?php echo date('d-m-Y', strtotime($sampai_tanggal)); ?></span>
                    <span>Filter: <?php echo ucfirst($filter); ?></span>
                    <form action="<?php echo site_url('laporan/download_pdf'); ?>" method="post">
                        <input type="hidden" name="mulai_tanggal" value="<?php echo $mulai_tanggal; ?>">
                        <input type="hidden" name="sampai_tanggal" value="<?php echo $sampai_tanggal; ?>">
                        <input type="hidden" name="filter" value="<?php echo $filter; ?>">
                        <button type="submit" class="btn btn-primary">Download Laporan</button>
                    </form>
                </div>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0; // Inisialisasi total
                        foreach ($laporan as $item): 
                            // Jika ini adalah pengeluaran, tandai nominal sebagai negatif
                            if (isset($item->pengeluaran_deskripsi)) {
                                $nominal = -$item->nominal_keluar; // Tampilkan nominal pengeluaran sebagai negatif
                            } else {
                                $nominal = $item->nominal_masuk; // Nominal pemasukan tetap positif
                            }
                            $total += $nominal; // Akumulasi total
                        ?>
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($item->tanggal_masuk)); ?></td>
                                <td><?php echo isset($item->pengeluaran_deskripsi) ? $item->pengeluaran_deskripsi : $item->pemasukan_deskripsi; ?></td>
                                <td><?php echo number_format($nominal, 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong><?php echo number_format($total, 2, ',', '.'); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <p>Tidak ada laporan yang ditemukan. Silakan lakukan filter untuk mendapatkan laporan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        var footer = document.querySelector('footer');

        sidebar.classList.toggle('closed');
        content.classList.toggle('shifted');

        // Toggle class full-width pada footer
        footer.classList.toggle('full-width');
    });
</script>
