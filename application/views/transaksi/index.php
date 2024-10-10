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

  <div class="container">
    <div class="d-flex justify-content-between mb-3">
      <div>
        <h4>Transaksi Keuangan</h4>
      </div>
      <div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransactionModal">Tambah
          Transaksi</button>
      </div>
    </div>

    <!-- Pesan Sukses dan Error -->
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-failed"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <!-- Tampilkan daftar transaksi di sini -->
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nominal</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
          <th>Jenis</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody id="transaksiTable">
        <!-- Loop melalui data transaksi -->
        <?php foreach ($transaksi as $key => $tran): ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td>Rp. <?= number_format($tran->nominal, 0, ',', '.') ?>,-</td>
            <td><?= date('d-m-Y', strtotime($tran->tanggal)) ?></td>
            <td><?= $tran->deskripsi ?></td>
            <td>
              <?php
              // Rename tipe_transaksi dengan warna
              if ($tran->tipe === 'income') {
                echo '<span style="color: green;">Pemasukan</span>'; // Warna hijau untuk Pemasukan
              }
              if ($tran->tipe === 'expense') {
                echo '<span style="color: red;">Pengeluaran</span>'; // Warna merah untuk Pengeluaran
              }
              ?>
            </td>
            <td>
              <a href="<?= base_url('index.php/transaksi/edit/' . $tran->id_transaksi) ?>"
                class="btn btn-warning btn-sm">Edit</a>
              <a href="<?= base_url('index.php/transaksi/hapus/' . $tran->id_transaksi) ?>"
                class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal untuk Tambah Transaksi -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTransactionModalLabel">Tambah Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('index.php/transaksi/simpan_transaksi') ?>" method="post" id="form_transaksi">
          <div class="mb-3">
            <label for="nominal_keluar" class="form-label">Nominal</label>
            <input type="number" class="form-control" name="nominal_keluar" id="nominal_keluar" required>
          </div>
          <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
          </div>
          <div class="mb-3">
            <label for="tipe_transaksi" class="form-label">Tipe Transaksi</label>
            <select class="form-select" name="tipe_transaksi" id="tipe_transaksi" required>
              <option value="">Pilih Tipe Transaksi</option>
              <option value="income">Pemasukan</option>
              <option value="expense">Pengeluaran</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </form>
      </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>