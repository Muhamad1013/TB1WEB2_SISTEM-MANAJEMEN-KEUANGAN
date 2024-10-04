<div class="container">
  <div class="login-box">
    <h2>Login Page</h2>

    <?php if ($this->session->flashdata('registration_success')): ?>
      <div class="alert alert-success" role="alert">
        <?= $this->session->flashdata('registration_success'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-failed" role="alert">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/auth'); ?>" method="post">
      <input type="text" id="email" name="email" placeholder="Enter Email Address..." required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <button type="submit" id="login-button">Login</button>
    </form>
    <div class="separator"></div>
    <div class="options">
      <a href="<?= base_url('index.php/auth/registration'); ?>">Create an Account!</a>
    </div>
  </div>
</div>