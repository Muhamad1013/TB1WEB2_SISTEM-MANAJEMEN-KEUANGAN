<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $judul; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="<?= base_url(); ?>layout/css/style.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="logo">Keuangan<span>App</span></div>
      <div class="menu-icon" id="menu-toggle"><i class="fas fa-bars"></i></div>
      <div class="user-info">
        <img src="https://via.placeholder.com/30" alt="User Image">
        <span class="username"><?= $this->session->userdata('nama_pengguna'); ?></span>
        <a href="<?= base_url('index.php/auth/logout'); ?>" class="logout ml-4"><i class="fas fa-sign-out-alt"></i>
          LOGOUT</a>
      </div>

    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="text-center">
      <h2>KeuanganApp</h2>
      <p class="username"><?= $this->session->userdata('nama_pengguna'); ?></p>
    </div>
    <div class="container-icon">
      <a href="<?= base_url(); ?>"><i class="fas fa-tachometer-alt"></i>
        <p class="text-icon">Dashboard</p>
      </a>
      <a href="<?= base_url('index.php/Kategori'); ?>"><i class="fas fa-tags"></i>
        <p class="text-icon">Data Kategori</p>
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