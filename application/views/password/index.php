<div class="content" id="content">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9">
          <h3 class="mb-0">Change Password</h3>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Success and Error Messages -->
  <?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('error'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header blue-card">
          Form Change Password
        </div>
        <div class="card-body">
          <!-- Password Change Form -->
          <form id="changePasswordForm" method="POST" action="<?= base_url('index.php/password/update_password'); ?>">
            <div class="form-group">
              <label for="oldPassword">Old Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter Old Password" required>
                <div class="input-group-append">
                  <span class="input-group-text" onclick="togglePasswordVisibility('oldPassword')">
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </div>
              </div>
            </div>
  
            <div class="form-group">
              <label for="newPassword">New Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" required>
                <div class="input-group-append">
                  <span class="input-group-text" onclick="togglePasswordVisibility('newPassword')">
                    <i class="fas fa-eye-slash"></i>
                  </span>
                  
                </div>
              </div>
              <ul class="password-criteria mt-2">
                <li id="minLength" class="invalid">Minimum 6 characters</li>
                <li id="uppercase" class="invalid">At least 1 uppercase letter</li>
                <li id="lowercase" class="invalid">At least 1 lowercase letter</li>
              </ul>
            </div>
  
            <div class="form-group">
              <label for="confirmPassword">Confirm New Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required>
                <div class="input-group-append">
                  <span class="input-group-text" onclick="togglePasswordVisibility('confirmPassword')">
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </div>
              </div>
            </div>
  
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Fungsi untuk toggle password visibility
  function togglePasswordVisibility(id) {
    var passwordField = document.getElementById(id);
    var icon = passwordField.nextElementSibling.querySelector('i'); // Ambil elemen ikon

    if (passwordField.type === "password") {
      passwordField.type = "text"; // Ubah tipe menjadi text
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye"); // Ubah ikon menjadi eye
    } else {
      passwordField.type = "password"; // Ubah tipe kembali menjadi password
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash"); // Ubah ikon menjadi eye-slash
    }
  }
</script>
