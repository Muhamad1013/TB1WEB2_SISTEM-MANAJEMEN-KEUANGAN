<div class="content" id="content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9">
          <h3 class="mb-0">Dashboard</h3>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>

        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <div class="card green-card mb-3">
        <div class="card-header">Pemasukan Hari Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pemasukan_hari_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card blue-card mb-3">
        <div class="card-header">Pemasukan Bulan Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pemasukan_bulan_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card orange-card mb-3">
        <div class="card-header">Pemasukan Tahun Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pemasukan_tahun_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card black-card mb-3">
        <div class="card-header">Seluruh Pemasukan</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($seluruh_pemasukan ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="card red-card mb-3">
        <div class="card-header">Pengeluaran Hari Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pengeluaran_hari_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card red-card mb-3">
        <div class="card-header">Pengeluaran Bulan Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pengeluaran_bulan_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card red-card mb-3">
        <div class="card-header">Pengeluaran Tahun Ini</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($pengeluaran_tahun_ini ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card black-card mb-3">
        <div class="card-header">Seluruh Pengeluaran</div>
        <div class="card-body">
          <h5 class="card-title">Rp. <?= number_format($seluruh_pengeluaran ?: 0, 0, ',', '.') ?>,-</h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Data Pemasukan & Pengeluaran Per Bulan -->
  <div class="flex-row">
    <div class="chart-container">
      <h4>Grafik Pemasukan & Pengeluaran</h4>
      <canvas id="grafikKeuangan" width="300" height="150"></canvas>
    </div>
    <div class="calendar-container">
      <div class="calendar-text">
        <i class='far fa-calendar-alt' style='font-size:24px'></i>
        <h4>Kalender</h4>
      </div>
      <div id="calendar"></div>
    </div>
  </div>
</div>