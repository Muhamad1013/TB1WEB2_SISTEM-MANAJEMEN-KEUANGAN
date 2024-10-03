<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $judul; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

  <style>
    body {
      background-color: rgb(234, 234, 234);
      ;
      font-family: 'Arial', sans-serif;
    }

    .navbar {
      background-color: #4682B4;
      padding: 10px;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar .logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: white;
      cursor: pointer;
    }

    .navbar .logo span {
      font-weight: normal;
      font-size: 1.2rem;
      vertical-align: super;
      cursor: pointer;
    }


    .navbar .menu-icon {
      font-size: 1.5rem;
      color: white;
      cursor: pointer;
      margin-right: 650px;
    }

    .navbar .user-info {
      font-size: 1rem;
      color: white;
      display: flex;
      align-items: center;
    }

    .navbar .user-info img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .navbar .logout {
      color: white;
      margin-left: 10px;
      font-size: 1rem;
    }

    .sidebar {
      height: 100vh;
      position: fixed;
      width: 250px;
      background-color: #2c3e50;
      color: white;
      padding-top: 20px;
      left: 0;
      transition: left 0.3s ease;
    }

    .sidebar.closed {
      left: -250px;
    }

    .sidebar a {
      color: white;
      display: block;
      padding: 15px;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="logo">Keuangan<span>App</span></div>
      <div class="menu-icon" id="menu-toggle"><i class="fas fa-bars"></i></div>
      <div class="user-info">
        <img src="https://via.placeholder.com/30" alt="User Image">
        <span>Ahmad Jhony - administrator</span>
        <a href="#" class="logout ml-3"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2 class="text-center">KeuanganApp</h2>
    <p class="text-center">Ahmad Jhony - administrator</p>
    <a href="<?= base_url(); ?>">Dashboard</a>
    <a href="<?= base_url(); ?>index.php/Kategori">Data Kategori</a>
    <a href="<?= base_url(); ?>index.php/Pengguna">Data Pengguna</a>
    <a href="<?= base_url(); ?>index.php/Laporan">Laporan</a>
    <a href="<?= base_url(); ?>index.php/Password">Ganti Password</a>
    <a href="<?= base_url(); ?>index.php/Logout">Logout</a>
  </div>


  <script>
    // Toggle Sidebar
    document.getElementById('menu-toggle').addEventListener('click', function () {
      var sidebar = document.getElementById('sidebar');
      var content = document.getElementById('content');
      sidebar.classList.toggle('closed');
      content.classList.toggle('shifted');
    });
  </script>