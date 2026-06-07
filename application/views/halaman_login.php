<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form Kopi</title>
  <link rel="stylesheet" href="<?php echo base_url('assets2/css/a/styles.css'); ?>">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body style="background: url('<?php echo base_url('assets/images/kopi.jpg'); ?>') no-repeat center center fixed; background-size: cover;">

<div class="wrapper">
  <form action="<?php echo base_url('admin/serada_cru/proses_login'); ?>" method="POST">
    <h1>SRADDHA COFFEE</h1>

    <?php if ($this->session->flashdata('error')): ?>
      <div style="color: red; text-align: center; margin-bottom: 10px;">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <div class="input-box">
      <input type="text" name="username" placeholder="Username" required>
      <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
      <input type="password" name="password" placeholder="Password" required>
      <i class='bx bxs-lock-alt'></i>
    </div>

    <!-- Tombol Login -->
    <button type="submit" class="btn" style="width: 100%;">Login</button>

    <!-- Tombol Kembali di bawah login -->
<!-- Tombol Kembali di bawah login -->
    <button type="button"
            class="btn"
            onclick="window.location.href='<?= site_url('dashboard/index'); ?>'"
            style="width: 100%; margin-top: 10px;">
      Kembali
    </button>


  </form>
</div>

</body>
</html>
