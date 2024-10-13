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
            <button class="btn btn-warning btn-sm btn-edit" 
    data-toggle="modal" 
    data-target="#editTransaksiModal"
    data-id="<?= $tran->id_transaksi ?>"
    data-nominal="<?= $tran->nominal ?>"
    data-tanggal="<?= $tran->tanggal ?>"
    data-deskripsi="<?= $tran->deskripsi ?>"
    data-tipe="<?= $tran->tipe ?>">
    Edit
</button>
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

<!-- Modal Edit Transaksi -->
<div class="modal fade" id="editTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="editTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransaksiModalLabel">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTransaksiForm" method="POST" action="<?php echo site_url('transaksi/update_transaksi'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_transaksi" id="edit_id_transaksi">
                    <div class="form-group">
                        <label for="edit_nominal_keluar">Nominal</label>
                        <input type="number" class="form-control" id="edit_nominal_keluar" name="nominal_keluar" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_transaksi">Tanggal</label>
                        <input type="date" class="form-control" id="edit_tanggal_transaksi" name="tanggal_transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_tipe_transaksi">Tipe Transaksi</label>
                        <select class="form-control" id="edit_tipe_transaksi" name="tipe_transaksi" required>
                            <option value="income">Pemasukan</option>
                            <option value="expense">Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
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

  $(document).ready(function() {
    // Saat modal ditampilkan
    $('#editTransaksiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal

        // Ambil data dari atribut data-* tombol
        var id = button.data('id');
        var nominal = button.data('nominal');
        var tanggal = button.data('tanggal');
        var deskripsi = button.data('deskripsi');
        var tipe = button.data('tipe');

        // Isi input dengan data yang diambil
        var modal = $(this);
        modal.find('#edit_id_transaksi').val(id);
        modal.find('#edit_nominal_keluar').val(nominal);
        modal.find('#edit_tanggal_transaksi').val(tanggal);
        modal.find('#edit_deskripsi').val(deskripsi);
        modal.find('#edit_tipe_transaksi').val(tipe);
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>