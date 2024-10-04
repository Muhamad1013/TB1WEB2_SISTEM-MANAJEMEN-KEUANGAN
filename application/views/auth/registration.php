<div class="container">
  <div class="registration-box">
    <h2>Create an Account!</h2>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-failed" role="alert">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/auth/registration'); ?>" method="post">
      <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Full name" required>
      <input type="email" id="email" name="email" placeholder="Email Address" required>
      <input type="password" id="password1" name="password1" placeholder="Password" required>
      <input type="password" id="password2" name="password2" placeholder="Repeat Password" required>
      <button type="submit" id="register-button">Register Account</button>
    </form>
    <div class="separator"></div>
    <div class="options">
      <a href="<?= base_url('index.php/auth'); ?>">Already have an account? Login!</a>
    </div>
  </div>
</div>