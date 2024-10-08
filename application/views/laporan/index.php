<div class="content" id="content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9">
          <h3 class="mb-0">Laporan</h3>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Form -->
  <div class="row">
    <div class="col-md-12">
      <form action="<?php echo site_url('laporan/filter'); ?>" method="post">
        <div class="filter-laporan-box">
          <h4>Filter Laporan</h4>
          <label for="mulai_tanggal">Mulai Tanggal:</label>
          <input type="date" id="mulai_tanggal" name="mulai_tanggal" required>

          <label for="sampai_tanggal">Sampai Tanggal:</label>
          <input type="date" id="sampai_tanggal" name="sampai_tanggal" required>

          <label for="filter">Filter:</label>
          <select name="filter" id="filter">
            <option value="hari">Per Hari</option>
            <option value="bulan">Per Bulan</option>
            <option value="tahun">Per Tahun</option>
          </select>

          <button type="submit">Tampilkan</button>
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
          <span>Menampilkan laporan dari <?php echo date('d-m-Y', strtotime($mulai_tanggal)); ?> hingga
            <?php echo date('d-m-Y', strtotime($sampai_tanggal)); ?></span>
          <a href="<?php echo site_url('laporan/download'); ?>" class="btn btn-primary">Download Laporan</a>
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
            <?php foreach ($laporan as $item): ?>
              <tr>
                <td><?php echo $item->tanggal_masuk; ?></td>
                <td><?php echo $item->pemasukan_deskripsi; ?></td>
                <td><?php echo number_format($item->nominal_masuk, 2, ',', '.'); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-info text-center">
          <p>Tidak ada laporan yang ditemukan. Silakan lakukan filter untuk mendapatkan laporan.</p>
          <a href="<?php echo site_url('laporan/download'); ?>" class="btn btn-secondary">Download Laporan</a>
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