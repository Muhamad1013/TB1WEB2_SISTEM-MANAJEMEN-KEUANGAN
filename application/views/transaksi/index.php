<div class="content">
  <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h1>Data Transaksi Keuangan</h1>
    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a>
  </div>

  <hr>

  <div class="d-flex justify-content-between mb-3">
    <div class="form-group">
      <label for="filter-time">Filter Waktu:</label>
      <select id="filter-time" class="form-control" onchange="filterKategori()">
        <option value="all">Semua</option>
        <option value="daily">Per Hari</option>
        <option value="monthly">Per Bulan</option>
        <option value="yearly">Per Tahun</option>
      </select>
    </div>
    <input type="text" id="search" class="form-control ml-2" placeholder="Search...">
  </div>

  <!-- Tabel Kategori -->
  <div id="kategoriTable">
    <table class="table table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        foreach ($kategori as $k): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $k->deskripsi; ?></td>
            <td>
              <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
              <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
