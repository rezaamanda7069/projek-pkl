<?php
session_start();

if (empty($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

$idAdmin = $_SESSION['admin_id'];

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT username FROM admin WHERE id_admin = ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "i", $idAdmin);
mysqli_stmt_execute($stmt);

$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f2f2f2; padding-top: 40px; }
        .box {
            max-width: 450px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,.15);
        }
    </style>
</head>
<body>
<div class="box">
    <h3 class="text-center">Ubah Profil Admin</h3>

    <?php if (isset($_GET['pesan'])) { ?>
        <div class="alert alert-info">
            <?php echo htmlspecialchars($_GET['pesan']); ?>
        </div>
    <?php } ?>

    <form action="proses_profile_admin.php" method="POST">
        <div class="form-group">
            <label>Username Baru</label>
            <input type="text" class="form-control" name="username"
                   value="<?php echo htmlspecialchars($data['username']); ?>" required>
        </div>

        <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" class="form-control" name="password_lama" required>
            <small class="text-muted">Wajib diisi untuk menyimpan perubahan.</small>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" class="form-control" name="password_baru" minlength="12">
            <small class="text-muted">Kosongkan jika hanya ingin mengganti username.</small>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" class="form-control" name="konfirmasi_password">
        </div>

        <button type="submit" class="btn btn-success btn-block">
            Simpan Perubahan
        </button>

        <a href="dasbord.php" class="btn btn-default btn-block">
            Kembali ke Dashboard
        </a>
    </form>
</div>
</body>
</html>