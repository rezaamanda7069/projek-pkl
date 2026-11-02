<?php
require_once 'auth.php';
require_admin_login();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Password</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f2f2f2; padding: 40px 15px; }
        .box { max-width: 420px; margin: auto; padding: 25px; background: #fff; border-radius: 10px; }
    </style>
</head>
<body>
<div class="box">
    <h3 class="text-center">Ubah Password</h3>

    <?php show_flash(); ?>

    <form action="proses_ubah_password.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group">
            <label>Password Lama</label>
            <input class="form-control" type="password" name="password_lama" required>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input class="form-control" type="password" name="password_baru" minlength="12" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input class="form-control" type="password" name="konfirmasi_password" minlength="12" required>
        </div>

        <button class="btn btn-success btn-block" type="submit">Simpan Password</button>
    </form>

    <p class="text-center" style="margin-top:15px;">
        <a href="index.php">Kembali ke Dashboard</a>
    </p>
</div>
</body>
</html>