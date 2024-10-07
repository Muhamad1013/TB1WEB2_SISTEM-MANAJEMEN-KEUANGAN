<footer class="footer">
  <div class="footer-container">
    <div class="footer-column">
      <h4>Nama Kelompok</h4>
      <p>Kelompok 6</p>
    </div>
    <div class="footer-column">
      <h4>Anggota Kelompok</h4>
      <ul>
        <li>Arvian Syiddiq</li>
        <li>Muhamad Rafli</li>
        <li>Irfing Adrian</li>
        <li>Muhammad Syahrul Adha</li>
        <li>Salman Khairullah</li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Tema Tugas</h4>
      <p>Sistem Manajemen Keuangan</p>
    </div>
  </div>
  <div class="copyright">
    <p>&copy; 2024 Kelompok 6. All Rights Reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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



  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
    });

    calendar.render();
  });

  // Fungsi untuk memformat angka menjadi x.xxx,yy
  function formatAngka(angka) {
    return new Intl.NumberFormat('id-ID', {
      minimumFractionDigits: 0
    }).format(angka);
  }

  var ctx = document.getElementById('grafikKeuangan').getContext('2d');
  var maxDataValue = Math.max(...<?= json_encode($pemasukan_bulanan) ?>, ...<?= json_encode($pengeluaran_bulanan) ?>) *
    1.1;

  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
      ],
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
<script>
  function filterKategori() {
    var filter = document.getElementById("filter-time").value;

    // Lakukan request Ajax untuk filter data
    $.ajax({
      url: '<?= base_url("kategori/filter") ?>',
      type: 'POST',
      data: { filter: filter },
      success: function (response) {
        // Ganti isi tabel dengan data yang difilter
        $("#kategoriTable").html(response);
      }
    });
  }
</script>

<body>
  <html>