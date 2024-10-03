  <footer>
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
<body>
</html>

<style>
  footer {
    background-color: #4682B4; 
    color: white;
    padding: 20px 0; 
    font-size: 14px; 
    text-align: center;
    position: relative;
  }

  footer .footer-container {
    display: flex; 
    flex-wrap: wrap; 
    justify-content: space-between; 
    padding: 0 20px; 
    max-width: 1200px; 
    margin: 0 auto; 
  }

  footer .footer-column {
    flex: 1; 
    margin: 10px; 
  }

  footer .footer-column h4 {
    font-size: 18px; 
    margin-bottom: 15px;
    font-weight: bold; 
    color: #FFD700;
  }

  footer .footer-column ul {
    list-style-type: none; 
    padding: 0; 
  }

  footer .footer-column ul li {
    margin-bottom: 5px; 
  }

  footer .footer-column ul li a {
    color: white; 
    text-decoration: none;
    transition: color 0.3s; 
  }

  footer .footer-column ul li a:hover {
    color: #FFD700; 
  }

  footer .copyright {
    margin-top: 20px;
    font-size: 12px; 
    color: #fff; 
  }

  @media (max-width: 768px) {
    footer .footer-container {
      flex-direction: column; 
      text-align: center; 
    }

    footer .footer-column {
      margin: 20px 0;
    }
  }
</style>
