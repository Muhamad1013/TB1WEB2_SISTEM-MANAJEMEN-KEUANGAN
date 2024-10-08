<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $judul; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="<?= base_url(); ?>layout/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>layout/css/password.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="logo">Keuangan<span>App</span></div>
      <div class="menu-icon" id="menu-toggle"><i class="fas fa-bars"></i></div>
      <div class="user-info">
        <?php if ($this->session->userdata('nama_pengguna')) : ?>
          <img src="<?= base_url('uploads/' . ($this->session->userdata('gambar') ?? 'default.png')); ?>" 
               alt="User Image" 
               style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;" 
               onerror="this.onerror=null; this.src='<?= base_url('uploads/default.png'); ?>';">
          <span class="username"><?= $this->session->userdata('nama_pengguna'); ?></span>
          <a href="<?= base_url('index.php/auth/logout'); ?>" class="logout ml-4"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
        <?php else : ?>
          <img src="<?= base_url('uploads/default.png'); ?>" 
               alt="Default User Image" 
               style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;" 
               onerror="this.onerror=null; this.src='<?= base_url('uploads/default.png'); ?>';">
          <span class="username">Guest</span>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="text-center">
      <h2>KeuanganApp</h2>
      <p class="username"><?= $this->session->userdata('nama_pengguna') ?? 'Guest'; ?></p>
    </div>
    <div class="container-icon">
      <a href="<?= base_url(); ?>"><i class="fas fa-tachometer-alt"></i>
        <p class="text-icon">Dashboard</p>
      </a>
      <a href="<?= base_url('index.php/Transaksi'); ?>"><i class="fas fa-tags"></i>
        <p class="text-icon">Data Transaksi</p>
      </a>
      <a href="<?= base_url('index.php/Pengguna'); ?>"><i class="fas fa-users"></i>
        <p class="text-icon">Data Pengguna</p>
      </a>
      <a href="<?= base_url('index.php/Laporan'); ?>"><i class="fas fa-file-invoice" style="font-size: 20px; margin: 3px; margin-right: 5px"></i>
        <p class="text-icon">Laporan</p>
      </a>
      <a href="<?= base_url('index.php/Password'); ?>"><i class="fas fa-key"></i>
        <p class="text-icon">Ganti Password</p>
      </a>
      <a href="<?= base_url('index.php/auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i>
        <p class="text-icon">Logout</p>
      </a>
    </div>
  </div>
</body>

</html>
