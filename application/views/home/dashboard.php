<style>
  .content {
    margin-left: 250px;
    padding: 80px 20px 20px;
    transition: margin-left 0.3s ease;
  }

  .content.shifted {
    margin-left: 0px;
  }

  .head-text {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .head-text h2 {
    font-size: 30px;
    margin: 0;
    color: #333;
  }

  .head-text h3 {
    font-size: 15px;
    color: #333;
    display: flex;
    align-items: center;
    margin: 0;
    cursor: pointer;
  }

  .head-text h3 .separator {
    margin: 0 10px;
    color: #333;
    opacity: 0.3;
    font-size: 1.2rem;
  }

  .head-text h3 i {
    margin-right: 8px;
    font-size: 1.2rem;
    color: #4682B4;
  }

  .dashboard {
    color: black;
    opacity: 0.7;
  }

  .card {
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-body h5 {
    font-size: 1.2rem;
    font-weight: bold;
  }

  .icon-info {
    font-size: 1.2rem;
  }

  .more-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .card-header {
    font-weight: bold;
  }

  .green-card {
    background: rgb(67, 219, 14);
    background: linear-gradient(158deg, rgba(67, 219, 14, 1) 0%, rgba(52, 164, 13, 1) 50%);
    color: white;
    border-color: rgb(67, 219, 14);
  }

  .red-card {
    background: rgb(255, 35, 35);
    background: linear-gradient(158deg, rgba(255, 35, 35, 1) 0%, rgba(180, 10, 10, 1) 50%);
    border-color: rgb(255, 35, 35);
    color: white;
  }

  .blue-card {
    background: rgb(14, 184, 219);
    background: linear-gradient(158deg, rgba(14, 184, 219, 1) 0%, rgba(13, 113, 164, 1) 50%);
    color: white;
    border-color: rgb(14, 184, 219);
  }

  .orange-card {
    background: rgb(245, 215, 45);
    background: linear-gradient(158deg, rgba(245, 215, 45, 1) 0%, rgba(241, 183, 9, 1) 50%);
    color: white;
    border-color: rgb(245, 215, 45);
  }

  .black-card {
    background: rgb(75, 75, 75);
    background: linear-gradient(158deg, rgba(75, 75, 75, 1) 0%, rgba(14, 14, 14, 1) 50%);
    color: white;
    border-color: rgb(75, 75, 75);
  }

  .chart-container {
    width: 100%;
    max-width: 650px;
    margin-right: 20px;
    background: rgb(255, 255, 255);
    background: linear-gradient(158deg, rgba(255, 255, 255, 1) 0%, rgba(234, 234, 234, 1) 50%);
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .flex-row {
    display: flex;
    margin-top: 20px;
  }

  .row {
    display: flexbox;
    flex-wrap: nowrap;
  }

  .calendar-container {
    flex: 1;
    max-width: 100%;
    background-image: linear-gradient(#D7EFEF, #8FCACA);
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .calendar-container #calendar {
    padding: 0px;
  }

  .calendar-text {
    display: flex;
  }

  .calendar-text h4 {
    margin-left: 8px;
    margin-bottom: 5px;
  }

  .container-fluid {
    position: start;
  }
</style>
<div class="content" id="content">
  <div class="head-text">
    <h2>Dashboard</h2>
    <h3>
      <i class="fas fa-home" style="font-size: 0.9rem; color: black;"></i>
      Home <span class="separator">></span> <a class="dashboard" href="<?= base_url();?>">Dashboard</a>
    </h3>
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
      });

      calendar.render();
    });

    // Fungsi untuk memformat angka menjadi x.xxx,yy
    function formatAngka(angka) {
      return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(angka);
    }

    var ctx = document.getElementById('grafikKeuangan').getContext('2d');
    var maxDataValue = Math.max(...<?= json_encode($pemasukan_bulanan) ?>, ...<?= json_encode($pengeluaran_bulanan) ?>) * 1.1;

    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
          label: 'Pemasukan',
          backgroundColor: 'rgba(75, 192, 192, 0.8)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: <?= json_encode($pemasukan_bulanan) ?>,
        }, {
          label: 'Pengeluaran',
          backgroundColor: 'rgba(255, 99, 132, 0.8)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: <?= json_encode($pengeluaran_bulanan) ?>,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: maxDataValue,
            ticks: {
              callback: function (value) {
                return formatAngka(value); // Menggunakan fungsi formatAngka
              }
            }
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                return tooltipItem.dataset.label + ': ' + formatAngka(tooltipItem.raw); // Menggunakan formatAngka
              }
            }
          }
        }
      }
    });

  </script>
</div>