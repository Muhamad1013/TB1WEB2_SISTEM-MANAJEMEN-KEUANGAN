</body>
<script>
  document.getElementById("login-button").addEventListener("click", function (event) {
    // Ambil nilai dari input
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Validasi input
    if (email === "" || password === "") {
      alert("Please fill in both fields.");
      event.preventDefault(); // Mencegah pengiriman form
      return;
    }

    // Biarkan form dikirim ke server jika semua input valid
  });
</script>

</html>