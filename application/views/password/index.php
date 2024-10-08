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

  <!-- Menampilkan alert flashdata untuk pesan berhasil atau gagal -->
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
          <!-- Form untuk mengganti password -->
          <form id="changePasswordForm" method="POST" action="<?= base_url('password/index'); ?>">
            <div class="form-group">
              <label for="oldPassword">Old Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="oldPassword" name="oldPassword"
                  placeholder="Enter Old Password" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-eye-slash"
                      onclick="togglePasswordVisibility('oldPassword')"></i></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="newPassword">New Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="newPassword" name="newPassword"
                  placeholder="Enter New Password" required onkeyup="validatePassword()">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-eye-slash"
                      onclick="togglePasswordVisibility('newPassword')"></i></span>
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
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                  placeholder="Confirm New Password" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-eye-slash"
                      onclick="togglePasswordVisibility('confirmPassword')"></i></span>
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
  document.getElementById('menu-toggle').addEventListener('click', function () {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var footer = document.querySelector('footer');

    sidebar.classList.toggle('closed');
    content.classList.toggle('shifted');

    // Toggle class full-width pada footer
    footer.classList.toggle('full-width');
  });
</script>