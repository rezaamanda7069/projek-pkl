<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f2f2f2; padding: 40px 15px; }
        .box { max-width: 420px; margin: auto; padding: 25px; background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,.15); }
    </style>
</head>
<body>
<div class="box">
    <h3 class="text-center">Reset Password Admin</h3>
    <p class="text-muted text-center">Masukkan kode pemulihan yang hanya diketahui pengelola website.</p>

    <?php show_flash(); ?>

    <form action="proses_reset_password.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Kode Pemulihan</label>
            <input class="form-control" type="password" name="recovery_code" required>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input class="form-control" type="password" name="password_baru" minlength="12" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input class="form-control" type="password" name="konfirmasi_password" minlength="12" required>
        </div>

        <button class="btn btn-success btn-block" type="submit">Reset Password</button>
    </form>

    <p class="text-center" style="margin-top:15px;">
        <a href="login.php">Kembali ke Login</a>
    </p>
</div>
</body>
</html>